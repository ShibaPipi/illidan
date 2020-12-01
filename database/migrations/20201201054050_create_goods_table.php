<?php

use think\migration\Migrator;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateGoodsTable extends Migrator
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
        $this->table('goods')
            ->addColumn('title', 'string', ['default' => '', 'comment' => '标题'])
            ->addColumn('category_id', 'integer', ['default' => 0, 'comment' => '分类 id'])
            ->addColumn('category_path', 'string', ['limit' => 20, 'default' => 0, 'comment' => '分类栏目 path'])
            ->addColumn('promotion', 'string', ['default' => '', 'comment' => '促销语'])
            ->addColumn('unit', 'string', ['limit' => 20, 'default' => '', 'comment' => '单位'])
            ->addColumn('keywords', 'string', ['default' => '', 'comment' => '关键字'])
            ->addColumn('sub_title', 'string', ['limit' => 100, 'default' => '', 'comment' => '副标题'])
            ->addColumn('stock', 'integer', ['default' => 0, 'comment' => '库存'])
            ->addColumn('price', 'decimal', ['default' => '0', 'comment' => '现价'])
            ->addColumn('cost', 'decimal', ['default' => '0', 'comment' => '原价'])
            ->addColumn('sku_id', 'integer', ['default' => 0, 'comment' => '默认 sku id'])
            ->addColumn('is_show_stock', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1, 'comment' => '是否显示库存'])
            ->addColumn('production_time', 'string', ['default' => '', 'comment' => '生产日期'])
            ->addColumn('specs_type', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1, 'comment' => '规则：1单规格，2多规格'])
            ->addColumn('big_image', 'string', ['default' => '', 'comment' => '大图'])
            ->addColumn('recommend_image', 'string', ['default' => '', 'comment' => '推荐图'])
            ->addColumn('carousel_image', 'string', ['limit' => 500, 'default' => '', 'comment' => '详情页轮播图'])
            ->addColumn('description', 'text', ['default' => '', 'comment' => '详情'])
            ->addColumn('is_index_recommend', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1, 'comment' => '是否为首页推荐商品'])
            ->addColumn('specs_data', 'string', ['default' => '', 'comment' => '多规格属性 json'])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'signed' => false, 'default' => 1, 'comment' => '状态：0待审核，1正常，99删除'])
            ->addColumn('create_time', 'integer', ['default' => 0, 'comment' => '创建时间'])
            ->addColumn('update_time', 'integer', ['default' => 0, 'comment' => '更新时间'])
            ->addColumn('operator_id', 'integer', ['default' => 0, 'comment' => '操作人 id'])
            ->create();
    }
}
