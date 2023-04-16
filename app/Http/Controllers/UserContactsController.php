<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Contact\ContactRequest;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Models\UserContact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserContactsController extends Controller
{
    public function index(ContactRequest $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');

        $cache_key = 'user_contacts.' . $offset . '.' . $limit . '.' . auth()->id();

        $user_contacts = Cache::tags(['user_contacts', 'user:' . $offset . '.' . $limit . auth()->id()])->remember($cache_key, 60, function () use ($offset, $limit) {
            return UserContact::forCurrentUser()->offset($offset)->limit($limit)->get();
        });

        return response([
            'user_contacts' => $user_contacts
        ]);
    }

    public function show($id)
    {
        $cache_key = 'user_contacts.' . $id . auth()->id();

        $user_contact = Cache::tags(['user_contact', 'user:' . auth()->id()])->remember($cache_key, 60, function () use ($id) {
            return UserContact::forCurrentUser($id)->get();
        });

        return response([
            'user_contact' => $user_contact
        ]);
    }

    public function search(Request $request)
    {
        $params = $request->only(['name', 'phone', 'offset', 'limit']);
        $cache_key = 'user_contacts.' . md5(serialize($params)) . '.' . auth()->id();

        $user_contacts = Cache::tags(['user_contacts', 'user:' . auth()->id()])->remember($cache_key, 60, function () use ($params) {
            return UserContact::search($params)->forCurrentUser()->get();
        });

        return response([
            'user_contacts' => $user_contacts
        ]);
    }

    public function store(StoreContactRequest $request)
    {
        $user_contact = new UserContact();
        $user_contact->user_id = auth()->id();
        $user_contact->name = $request->input('name');
        $user_contact->phone = $request->input('phone');

        if ($user_contact->save()) {
            Cache::tags(['user_contacts', 'user:' . auth()->id()])->flush();

            return response([
                'message' => 'Successfully created.',
                'contact' => $user_contact
            ], 201);
        }

        return response([
            'message' => 'Something went wrong!'
        ], 400);
    }

    public function update(UpdateContactRequest $request, $id)
    {
        $user_contact = UserContact::forCurrentUser($id)->first();

        if ($user_contact) {
            $user_contact->name = $request->input('name', $user_contact->name);
            $user_contact->phone = $request->input('phone', $user_contact->phone);
            if ($user_contact->update()) {
                Cache::tags(['user_contacts', 'user:' . auth()->id()])->flush();

                return response([
                    'message' => 'Successfully updated.',
                    'user_contact' => $user_contact
                ]);
            }
        }

        return response([
            'message' => 'Something went wrong!'
        ], 400);
    }

    public function delete($id)
    {
        $user_contact = UserContact::forCurrentUser($id)->first();

        if ($user_contact) {
            $user_contact->delete();
            Cache::tags(['user_contacts', 'user:' . auth()->id()])->flush();

            return response([
                'message' => 'Successfully deleted.'
            ]);
        }

        return response([
            'message' => 'Something went wrong!'
        ], 400);
    }
}
