<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class CreateCategoryTable extends Migrator
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('category');
        $table->addColumn('name', 'string', ['default' => '', 'comment' => '分类名称'])
            ->addColumn('pid', 'integer', ['default' => 0, 'comment' => '父级id'])
            ->addColumn('icon', 'string', ['default' => '', 'comment' => '分类图标'])
            ->addColumn('path', 'string', ['default' => '', 'comment' => '分类路径'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '状态：0待审核，1正常，99删除'])
            ->addColumn('sort', 'integer', ['default' => 1, 'comment' => '排序'])
            ->addColumn('create_time', 'integer', ['default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['default' => 0, 'comment' => '更新时间'])
            ->addColumn('operator_id', 'integer', ['default' => 0, 'comment' => '操作人 id'])
            ->addIndex('name', ['unique' => true])
            ->create();
    }
}
