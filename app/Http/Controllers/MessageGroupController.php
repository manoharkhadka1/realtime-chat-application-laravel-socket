<?php

namespace App\Http\Controllers;

use App\MessageGroup;
use App\MessageGroupMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data['name'] = $request->name;
        $data['user_id'] = Auth::id();

        $messageGroup = MessageGroup::create($data);

        if ($messageGroup) {
            if(isset($request->user_id) && !empty($request->user_id)) {
                foreach ($request->user_id as $userId) {
                    $memberData['user_id'] = $userId;
                    $memberData['message_group_id'] = $messageGroup->id;
                    $memberData['status'] = 0;

                    MessageGroupMember::create($memberData);
                }
            }
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('id', '!=', Auth::id())->get();
        $myInfo = User::find(Auth::id());
        $groups = MessageGroup::get();
        $currentGroup = MessageGroup::where('id', $id)
            ->with('message_group_members.user')
            ->first();

        $this->data['users'] = $users;
        $this->data['myInfo'] = $myInfo;
        $this->data['groups'] = $groups;
        $this->data['currentGroup'] = $currentGroup;

        return view('message_groups.index', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
