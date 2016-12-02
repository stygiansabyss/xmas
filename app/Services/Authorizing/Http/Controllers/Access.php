<?php

namespace App\Services\Authorizing\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateAccessLevel;
use App\Services\Authorizing\Models\Access as AccessModel;
use NukaCode\Users\Models\Role;

class Access extends BaseController
{
    /**
     * @var \App\Services\Authorizing\Models\Access
     */
    private $accesses;

    /**
     * Access constructor.
     *
     * @param \App\Services\Authorizing\Models\Access $accesses
     */
    public function __construct(AccessModel $accesses)
    {
        $this->accesses = $accesses;
    }

    public function index()
    {
        $this->setViewData('accesses', $this->accesses->orderBy('email', 'asc')->get());

        return $this->view();
    }

    public function create()
    {
        $this->setViewData('roles', Role::where('name', '!=', 'guest')->pluck('label', 'id'));

        return $this->view();
    }

    public function store(CreateAccessLevel $request)
    {
        $this->accesses->create($request->all());

        return redirect(route('access.index'))
            ->with('message', 'Access level granted.');
    }

    public function edit($id)
    {
        $access = $this->accesses->find($id);
        $roles = Role::where('name', '!=', 'guest')->pluck('label', 'id');

        $this->setViewData(compact('access', 'roles'));

        return $this->view();
    }

    public function update(CreateAccessLevel $request, $id)
    {
        $this->accesses->find($id)->update($request->all());

        return redirect(route('access.index'))
            ->with('message', 'Access level updated.');
    }

    public function delete($id)
    {
        $this->accesses->find($id)->delete();

        return redirect(route('access.index'))
            ->with('message', 'Access level revoked.');
    }
}
