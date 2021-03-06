<?php

use Phinx\Db\Adapter\MysqlAdapter;
use think\migration\Migrator;
use think\migration\db\Column;

class CreateUserTable extends Migrator
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
        $table = $this->table('user');
        $table->addColumn('username', 'string', ['limit' => 100, 'default' => '', 'comment' => '用户名'])
            ->addColumn('telephone', 'string', ['limit' => 20, 'default' => '', 'comment' => '用户密码'])
            ->addColumn('password', 'string', ['limit' => 32, 'default' => md5('123456'), 'comment' => '用户密码'])
            ->addColumn('login_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '登录方式：1手机号验证码，2账号密码'])
            ->addColumn('remember_days', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '会话保存天数：1->7天，2->30天'])
            ->addColumn('gender', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 0, 'comment' => '性别：0保密，1男，2女'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '状态：0待审核，1正常，99删除'])
            ->addColumn('create_time', 'integer', ['default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['default' => 0, 'comment' => '更新时间'])
            ->addColumn('last_login_time', 'integer', ['default' => 0, 'comment' => '最后登录时间'])
            ->addColumn('last_login_ip', 'string', ['limit' => 100, 'default' => '', 'comment' => '最后登录 IP'])
            ->addColumn('operator_id', 'integer', ['default' => 0, 'comment' => '操作人 id'])
            ->addIndex('username', ['unique' => true])
            ->addIndex('telephone', ['unique' => true])
            ->create();
    }
}
