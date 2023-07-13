<?php
    include(__DIR__.'../../helpers/linkurladmin.php');
    return [
        [ // quản lý user  
            'label' => 'Trang Chủ',
            'segment' =>'index.php',
            'link' => showlink().'/index.php',
            'icon' => 'home'
        ],
        [ // quản lý user  
            'label' => 'Quản lý Người Dùng',
            'segment' =>'quanlyuser',
            'link' => 'index.php',
            'icon' => 'universal-access',
            'items' => [
                [
                    'label' => 'Xem user',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Cộng tác viên',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Quản trị',
                    'link' => 'index.php',
                ],
            ]
        ],
        [ // quản lý slide
            'label' => 'Quản lý slide',
            'segment' =>'slide',
            'link' => 'index.php',
            'icon' => 'slideshow',
            'items' => [
                [
                    'label' => 'Xem slide',
                    'link' => showlink().'/slide/index.php',
                ],
                [
                    'label' => 'Thêm Slide',
                    'link' => showlink().'/slide/addslide.php',
                ],
            ]
        ],
        [ // quản lý danh mục
            'label' => 'Quản lý Danh mục',
            'segment' =>'category',
            'link' => 'index.php',
            'icon' => 'objects-horizontal-left',
            'items' => [
                [
                    'label' => 'Xem Danh Mục',
                    'link' => showlink().'/category/index.php',
                ],
                [
                    'label' => 'Thêm Danh Mục',
                    'link' => showlink().'/category/addcategory.php',
                ],
            ]
        ],
        [ // quản lý mã giảm giá
            'label' => 'Quản lý Mã giảm giá',
            'segment' =>'voucher',
            'link' => 'index.php',
            'icon' => 'purchase-tag-alt',
            'items' => [
                [
                    'label' => 'Xem Mã giảm giá',
                    'link' => showlink().'/voucher/index.php',
                ],
                [
                    'label' => 'Thêm Mã giảm giá',
                    'link' => showlink().'/voucher/addvoucher.php',
                ],
            ]
        ],
        [ // quản lý sản phẩm
            'label' => 'Quản lý Sản Phẩm',
            'segment' =>'product',
            'link' => 'index.php',
            'icon' => 'store-alt',
            'items' => [
                [
                    'label' => 'Xem Sản phẩm',
                    'link' => showlink().'/product/index.php',
                ],
                [
                    'label' => 'Thêm Sản Phẩm',
                    'link' => showlink().'/product/addproduct.php',
                ],
            ]
        ],
        [ // quản lý đơn hàng
            'label' => 'Quản lý Đơn hàng',
            'segment' =>'order',
            'link' => 'index.php',
            'icon' => 'cart',
            'items' => [
                [
                    'label' => 'Xem Đơn Hàng',
                    'link' => showlink().'/order/index.php',
                ],
            ]
        ],
        [ // quản lý tin tức
            'label' => 'Quản lý Tin Tức',
            'segment' =>'news',
            'link' => 'index.php',
            'icon' => 'book-content',
            'items' => [
                [
                    'label' => 'Xem Tin Tức',
                    'link' => showlink().'/news/index.php',
                ],
                [
                    'label' => 'Thêm Tin Tức',
                    'link' => showlink().'/news/addnews.php',
                ],
            ]
        ],
        [ // quản lý vận chuyển
            'label' => 'Quản lý Vận chuyển',
            'segment' =>'quanlydonhang',
            'link' => 'index.php',
            'icon' => 'run',
            'items' => [
                [
                    'label' => 'Đơn vị vận chuyển',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Cài Đặt Phương Thức',
                    'link' => 'index.php',
                ],
            ]
        ],
        [ // quản lý vận chuyển
            'label' => 'Quản Lý Nhãn Hàng',
            'segment' =>'brand',
            'link' => 'index.php',
            'icon' => 'library',
            'items' => [
                [
                    'label' => 'Tất Cả',
                    'link' => showlink().'/brand/index.php',
                ],
                [
                    'label' => 'Thêm Nhãn Hàng',
                    'link' => showlink().'/brand/addbrand.php',
                ],
            ]
        ],
        [ // quản lý thống kê
            'label' => 'Thống kê',
            'segment' =>'quanlydonhang',
            'link' => 'index.php',
            'icon' => 'line-chart',
            'items' => [
                [
                    'label' => 'Thống Kê Đơn Hàng',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Thống Kê Sản Phẩm',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Thống Kê Truy Cập',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Thống Kê Đánh Giá',
                    'link' => 'index.php',
                ],
            ]
        ],
        [ // quản lý doanh thu
            'label' => 'Quản Lý Doanh Thu',
            'segment' =>'quanlydonhang',
            'link' => 'index.php',
            'icon' => 'wallet-alt',
            'items' => [
                [
                    'label' => 'Xem Doanh Thu',
                    'link' => 'index.php',
                ],
                [
                    'label' => 'Bảng tính lợi nhuận',
                    'link' => 'index.php',
                ],
            ]
        ],
    ];  
?>