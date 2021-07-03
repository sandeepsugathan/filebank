<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
    * Users list
    *
    * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
    *
    * @param Request $request
    *
    * @return Illuminate\View\View
    */
    public function index(Request $request)
    {
        $users = User::where('id', '!=', Auth::user()->id)
            ->orderBy('name')
            ->paginate(config('env.items_per_page'));
        return view('users.list', compact('users'));
    }

    /**
    * Create new user
    *
    * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
    *
    * @return Illuminate\View\View
    */
    public function add()
    {
        $pageHeader = __('user.add_user_header');
        $pagetitle = __('user.add_user_title');
        $user = new User();
        return view('users.update', compact('user', 'pageHeader', 'pagetitle'));
    }

    /**
    * Edit user
    *
    * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
    *
    * @param Request $request
    * @param App\Models\User $user
    *
    * @return Illuminate\View\View
    */
    public function edit(Request $request, $user)
    {
        $pageHeader = __('user.edit_user_header');
        $pagetitle = __('user.edit_user_title');
        return view('users.update', compact('user', 'pageHeader', 'pagetitle'));
    }

    /**
    * Save/update user
    *
    * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
    *
    * @param Request $request
    *
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request)
    {
        $message = [
            'class' => 'danger',
            'message' => ($request->id) ? __('user.update_user_failed') : __('user.add_user_failed')
        ];
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required_without:id|max:255',
            'type' => 'required',
            'confirm_password' => 'required_with:password|same:password',
        ]);
        $user = User::firstOrNew(['id' => $request->id]);
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->admin = $request->type;
            $user->save();
            $message = [
                'class' => 'success',
                'message' => ($request->id) ? __('user.update_user_success') : __('user.add_user_success')
            ];
        } catch (\Exception $e) {
            $logMessage = ($request->id) ? 'User update failed for user: '.$user->id : 'User creation failed';
            \Log::error($logMessage.'. Exception: '.$e->getMessage());
            return redirect()->back()->with('alertMessage', $message);
        }
        return redirect(route('users.index'))->with('alertMessage', $message);
    }

    /**
    * Delete user
    *
    * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
    *
    * @param Request $request
    * @param App\Models\User $user
    *
    * @return \Illuminate\Http\Response
    */
    public function delete(Request $request, $user)
    {
        $message = [
            'class' => 'danger',
            'message' => __('user.delete_user_failed')
        ];
        try {
            $user->delete();
            $message = [
                'class' => 'success',
                'message' => __('user.delete_user_success')
            ];
        } catch (\Exception $e) {
            \Log::error('Delete user failed for user: '.$user->id.'. Exception: '.$e->getMessage());
        }
        return redirect(route('users.index'))->with('alertMessage', $message);
    }

}
