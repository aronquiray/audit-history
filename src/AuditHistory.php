<?php
/**
 * Created by PhpStorm.
 * User: lloric
 * Date: 3/26/19
 * Time: 1:06 PM
 */

namespace HalcyonLaravel\AuditHistory;

use Exception;
use HalcyonLaravel\AuditHistory\Models\Contracts\AuditHistoryInterface;
use Illuminate\Support\Str;
use InvalidArgumentException;

class AuditHistory
{
    /**
     * @var
     */
    private $auditHistories;

    /**
     * @param  string  $className
     * @param  int|null  $id
     *
     * @return $this
     */
    public function buildClass(string $className, int $id = null)
    {
        if (!(app($className) instanceof AuditHistoryInterface)) {
            throw new InvalidArgumentException("Argument class [$className] must implemented in ".AuditHistoryInterface::class);
        }

        $entity = Str::slug(class_basename($className), '_');

        $this->auditHistories = $this->checkUserPermissions()
            ->where('auditable_type', $className)
            ->orWhere('tags', 'like', "media_entity_{$entity}%");

        if (!is_null($id)) {
            $this->auditHistories = $this->auditHistories
                ->where('auditable_id', $id);
        }
        return $this;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    private function checkUserPermissions()
    {
//        if ($this->_isNotMasterRole) {
//            return $this->_userBuild();
//        }

        return app(config('audit.implementation'));
    }

    /**
     * @param  int|null  $paginate
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function render(int $paginate = null)
    {
        if (empty($this->auditHistories)) {
            throw new Exception('No query selected for History Model');
        }

        $histories = $this->auditHistories->with('user')->latest();
        if (is_null($paginate)) {
            $histories = $histories->get();
        } else {
            $histories = $histories->paginate($paginate);
        }

        return view('audit-history::list', compact('histories', 'paginate'));
    }
}
