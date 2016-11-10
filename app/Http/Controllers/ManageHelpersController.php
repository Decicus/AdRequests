<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ManageHelpersRequest;
use App\User;

class ManageHelpersController extends Controller
{
    /**
     * Redirects with a message back to the admin page for helpers.
     *
     * @param  string $message
     * @param  string $type
     * @return Response
     */
    private function redirect($message, $type = 'warning')
    {
        return redirect()->route('admin.helpers.base')->with('message', [
            'type' => $type,
            'body' => $message
        ]);
    }

    /**
     * Adds a helper specified by username.
     *
     * @param ManageHelpersRequest $request
     * @return Response
     */
    public function add(ManageHelpersRequest $request)
    {
        $username = $request->input('username');
        $user = User::where(['name' => $username])->get()->first();

        if ($user->helper) {
            return $this->redirect('This user is already a helper.');
        }

        $user->helper = true;
        $user->save();

        return $this->redirect($username . ' has been added as a helper.', 'success');
    }

    /**
     * Removes a helper specified by username.
     *
     * @param  ManageHelpersRequest $request
     * @return Response
     */
    public function delete(ManageHelpersRequest $request)
    {
        $username = $request->input('username');
        $user = User::where(['name' => $username])->get()->first();

        if (!$user->helper) {
            return $this->redirect('This user is not a helper.');
        }

        $user->helper = false;
        $user->save();

        return $this->redirect($username . ' has been removed as a helper.', 'success');
    }
}
