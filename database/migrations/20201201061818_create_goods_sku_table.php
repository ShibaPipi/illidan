<?php

use think\migration\Migrator;
use think\migration\db\Column;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateGoodsSkuTable extends Migrator
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
        $this->table('goods_sku')
            ->addColumn('goods_id', 'integer', ['default' => 0, 'comment' => '商品 id'])
            ->addColumn('specs_value_ids', 'string', ['limit' => 20, 'default' => 0, 'comment' => '规则属性 id 组合'])
            ->addColumn('stock', 'integer', ['default' => 0, 'comment' => '库存'])
            ->addColumn('price', 'decimal', ['default' => '0', 'comment' => '现价'])
            ->addColumn('cost', 'decimal', ['default' => '0', 'comment' => '原价'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '状态：0待审核，1正常，99删除'])
            ->addColumn('create_time', 'integer', ['default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['default' => 0, 'comment' => '更新时间'])
            ->addColumn('operator_id', 'integer', ['default' => 0, 'comment' => '操作人 id'])
            ->setComment('商品 sku 表')
            ->create();
    }
}
