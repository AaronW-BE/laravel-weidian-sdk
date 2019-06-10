<?php


namespace Heymom\Weidian\Constants;


interface WeidianCMD
{
    /**
     * 获取订单列表
     */
    const VDIAN_ORDER_LIST = "vdian.order.list.get";

    /**
     * 获取订单
     */
    const VDIAN_ORDER = "vdian.order.get";

    /**
     * 添加商品
     */
    const VDIAN_GOODS_ADD = "vdian.item.add";

    /**
     * 商品详情
     */
    const VDIAN_GOODS_DETAIL = " vdian.item.getItemDetail";

    /**
     * 删除单个商品
     */
    const VDIAN_GOODS_DELETE = "vdian.item.delete";

    /**
     * 更新商品
     */
    const VDIAN_GOODS_UPDATE = "  vdian.item.update";

    /**
     * 执行退款
     */
    const VDIAN_GOODS_REFUND_ACCEPT = "vdian.order.refund.accept";
}