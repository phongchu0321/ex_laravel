<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="/front/css/main.css" />
    <link href="/front/css/output.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/front/images/icon/themify-icons-font/themify-icons/themify-icons.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel="stylesheet" href="/front/css/header.css">
    @vite('resources/css/app.css')
</head>

{{-- <body class="w-full md:w-[1200px] m-auto"> --}}
<body class="m-auto">

    <!-- header -->
    @auth
    <div class="header fixed left-0 right-0 top-0 z-20 h-16">
        <div class="m-auto flex items-center justify-between px-3">
            <i class="fi fi-rr-menu-burger md:hidden" onclick="toggleSidebar()"></i>
            <a class="logo" href="#"><img height="64" width="64" src="/front/images/Alone Dolphin.png"
                    alt="alone dolphin"></a>
            <div class="hidden md:flex items-center gap-10 cursor-pointer">
                <div class="h-fit"><a href="/">Trang chủ</a> </div>
                <div class="h-fit"><a href="/about_us">Giới thiệu</a></div>
                <div class="h-fit hover-product">
                    <a href="#" class="btn-product">Sản phẩm</a>
                    <div class="content-sub-menu">
                        <div class="container-sub-menu w-[1200px] m-auto">
                            <div class="sub-menu">
                                <ul>
                                    @foreach($rooms_header as $room)
                                    <li>
                                        <a href="/{{ $room->link }}">{{ $room->name }}</a>
                                        <ul class="details-menu details-{{ $room->link }}">

                                            @foreach($categories_header as $cate)
                                            @if($cate->room_id == $room->id)
                                            <li>
                                                <a href="/{{ $room->link }}/{{ $cate->id }}">{{ $cate->name }}</a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="img-sub-menu">
                                <a href="#"><img src="/front/images/img-menu/image_menu_products.webp"
                                        alt="image menu"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-fit"><a href="#footer">Liên hệ</a></div>
            </div>
            <div class="right-header flex content-center gap-6">
                <div class="text-gray-700 relative my-auto min-w-[100px] md:min-w-[250px]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <button class="p-1 text-gray-400 focus:outline-none focus:shadow-outline">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 text-[#6B7280]">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </span>
                    <input type="search" class="
                    w-full
                    text-sm
                    font-normal
                    border
                    pl-8
                    pr-2
                    h-8
                    rounded-md
                    bg-white
                    text-gray-500
                    focus:text-gray-900 focus:outline-none
                  " placeholder="Tìm kiếm sản phẩm..." />
                </div>
                <!-- <a href="/profile" class="h-8 w-8">
                    <img src="/icon/user-solid.svg" alt="" class="h-8 w-8">
                </a>
                <a href="/cart" class="h-8 w-8">
                    <img src="/icon/cart-shopping-solid.svg" alt="" class="h-8 w-8">
                </a> -->
                <a href="/profile" class="flex items-center"><i class="fi fi-rr-user"></i></a>
                <a href="/cart" class="flex items-center">
                    <i class="fi fi-rr-shopping-cart"></i>
                </a>
                @if(auth()->user()->level == 1)
                <a href="/admin/add">Admin Page</a>
                @endif
            </div>
        </div>
    </div>

    <div id="sidebar" class="hidden fixed top-0 right-0 left-0 h-full w-full z-30 bg-white overflow-auto">
        <div class="p-5 border-b-2 border-b-yellow-500 relative">
            <div class="text-center text-2xl">Menu</div>
            <div class="absolute top-7" onclick="toggleSidebar()">
                <i class="fi fi-rr-cross"></i>
            </div>
        </div>
        <div class="pl-7 pb-10">
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="/">Trang chủ</a></div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="/about_us">Giới thiệu</a></div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg expanded">
                <div class="flex justify-between pr-3 content-center" onclick="handleExpand(event)">
                    <a>Sản phẩm</a>
                    <i class="fi fi-rr-angle-small-down"></i>
                </div>
                <div class="px-5 collapse-section">

                    @foreach($rooms_header as $room)
                    <div class="py-1 border-b border-b-yellow-500 text-lg">
                        <div class="flex justify-between pr-6 content-center">
                            <a href="/{{ $room->link }}">{{ $room->name }}</a>
                            <i class="fi fi-rr-angle-small-down" onclick="handleExpandChild(event)"></i>
                        </div>
                        <div class="pl-5 collapse-section">
                            @foreach($categories_header as $cate)
                            <div class="flex justify-start gap-4 content-center">
                                @if($cate->room_id == $room->id)
                                <a href="/{{ $room->link }}/{{ $cate->id }}">{{ $cate->name }}</a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="#footer">Liên hệ</a></div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="/blog">Blog</a></div>
        </div>
    </div>
    @else

    <div class="header fixed left-0 right-0 top-0 z-20 h-16">
        <div class="m-auto flex items-center justify-between px-3">
            <i class="fi fi-rr-menu-burger md:hidden" onclick="toggleSidebar()"></i>
            <a class="logo" href="#"><img height="64" width="64" src="/front/images/Alone Dolphin.png"
                    alt="alone dolphin"></a>
            <div class="hidden md:flex items-center gap-10 cursor-pointer">
                <div class="h-fit"><a href="/">Trang chủ</a> </div>
                <div class="h-fit"><a href="/about_us">Giới thiệu</a></div>
                <div class="h-fit hover-product">
                    <a href="#" class="btn-product">Sản phẩm</a>
                    <div class="content-sub-menu">
                        <div class="container-sub-menu m-auto">
                            <div class="sub-menu">
                                <ul>
                                    @foreach($rooms_header as $room)
                                    <li>
                                        <a href="/{{ $room->link }}">{{ $room->name }}</a>
                                        <ul class="details-menu details-{{ $room->link }}">

                                            @foreach($categories_header as $cate)
                                            @if($cate->room_id == $room->id)
                                            <li>
                                                <a href="/{{ $room->link }}/{{ $cate->id }}">{{ $cate->name }}</a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="img-sub-menu">
                                <a href="#"><img src="/front/images/img-menu/image_menu_products.webp"
                                        alt="image menu"></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-fit"><a href="#footer">Liên hệ</a></div>
                <div class="h-fit"><a href="#">Blog</a></div>
            </div>
            <div class="right-header flex content-center gap-6">
                <div class="text-gray-700 relative my-auto min-w-[100px] md:min-w-[250px]">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <button class="p-1 text-gray-400 focus:outline-none focus:shadow-outline">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 text-[#6B7280]">
                                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </span>
                    <input type="search" class="
                    w-full
                    text-sm
                    font-normal
                    border
                    pl-8
                    pr-2
                    h-8
                    rounded-md
                    bg-white
                    text-gray-500
                    focus:text-gray-900 focus:outline-none
                  " placeholder="Tìm kiếm sản phẩm..." />
                </div>
                <!-- <a href="/profile" class="h-8 w-8">
                    <img src="/icon/user-solid.svg" alt="" class="h-8 w-8">
                </a>
                <a href="/cart" class="h-8 w-8">
                    <img src="/icon/cart-shopping-solid.svg" alt="" class="h-8 w-8">
                </a> -->
                <a href="/sign_in" class="flex items-center"><i class="fi fi-rr-user"></i></a>
                <a href="/cart" class="flex items-center">
                    <i class="fi fi-rr-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>

    <div id="sidebar" class="hidden fixed top-0 right-0 left-0 h-full w-full z-30 bg-white overflow-auto">
        <div class="p-5 border-b-2 border-b-yellow-500 relative">
            <div class="text-center text-2xl">Menu</div>
            <div class="absolute top-7" onclick="toggleSidebar()">
                <i class="fi fi-rr-cross"></i>
            </div>
        </div>
        <div class="pl-7 pb-10">
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="/">Trang chủ</a></div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="/about_us">Giới thiệu</a></div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg expanded">
                <div class="flex justify-between pr-3 content-center" onclick="handleExpand(event)">
                    <a>Sản phẩm</a>
                    <i class="fi fi-rr-angle-small-down"></i>
                </div>
                <div class="px-5 collapse-section">

                    @foreach($rooms_header as $room)
                    <div class="py-1 border-b border-b-yellow-500 text-lg">
                        <div class="flex justify-between pr-6 content-center">
                            <a href="/{{ $room->link }}">{{ $room->name }}</a>
                            <i class="fi fi-rr-angle-small-down" onclick="handleExpandChild(event)"></i>
                        </div>
                        <div class="pl-5 collapse-section">
                            @foreach($categories_header as $cate)
                            <div class="flex justify-start gap-4 content-center">
                                @if($cate->room_id == $room->id)
                                <a href="/{{ $room->link }}/{{ $cate->id }}">{{ $cate->name }}</a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="#footer">Liên hệ</a></div>
            <div class="py-2 border-b-2 border-b-yellow-500 text-lg"><a href="/blog">Blog</a></div>

        </div>
    </div>

    @endauth
    @yield('content')



    <script>
        function handleExpand(event) {
            const collapsible = event.currentTarget;
            const parent = collapsible.parentElement;
            parent.classList.toggle("expanded")
        }

        function handleExpandChild(event) {
            const collapsible = event.currentTarget;
            const parent = collapsible.parentElement.parentElement;
            parent.classList.toggle("expanded")
        }

        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar")
            console.log(sidebar)
            sidebar.classList.toggle("hidden")
        }
    </script>
</body>
