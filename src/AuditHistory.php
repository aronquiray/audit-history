<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/26/19
 * Time: 1:06 PM
 */

namespace HalcyonLaravel\AuditHistory;

use Exception;

class AuditHistory
{
    private $auditHistories;

    public function buildClass(string $className)
    {
        $this->auditHistories = $this->checkUserPermissions()
            ->where('auditable_type', $className);
        return $this;
    }

    private function checkUserPermissions()
    {
//        if ($this->_isNotMasterRole) {
//            return $this->_userBuild();
//        }

        return app(config('audit.implementation'));
    }


    /**
     * @param int|null $paginate
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function render(int $paginate = null)
    {

        if (empty($this->auditHistories)) {
            throw new Exception('No query selected for History Model');
        }
        $histories = $this->auditHistories->with('user');
        if (!is_null($paginate)) {
            $histories = $histories->paginate($paginate);
        } else {
            $histories = $histories->get();
        }
        return view('audit-history::list', compact('histories', 'paginate'));
    }
}