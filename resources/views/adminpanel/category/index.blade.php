@extends('adminpanel.layouts.app')
@section('title', 'Categories')
@section('content')
    <div class="content flex-row-fluid" id="kt_content">
        <div class="d-flex">
            <button class="btn btn-primary btn-sm" onclick="showModalAddCategory()"><span data-lang="button::Add category">Thêm
                    mới danh mục</span>
            </button>
            <button class="btn btn-primary btn-sm ms-3" onclick="showModalAddPlatform()"><span
                    data-lang="button::Add platform">Thêm mới nền tảng</span>
            </button>
        </div>
        <div class="p-5 text-muted text-end pointer" onclick="collapseAll()" id="collapse-all-btn">
            <span class="fst-italic" data-lang="Collapse all to modify platforms">Thu gọn tất cả để chỉnh sửa nền
                tảng</span>
            <i class="bi bi-arrows-collapse fs-4 ms-2" id="collapse-all-icon"></i>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-7 gy-2 gs-5 mb-0" id="table-platform">
                        @forelse($plat_cat as $pc)
                            <tbody class="tbody-{{ $pc['id'] }} sort-category" data-platform-id="{{ $pc['id'] }}"
                                id="sortablePlatforms">
                                <tr class="bg-secondary row-{{ $pc['id'] }} disabled tr-platform"
                                    data-platform-id="{{ $pc['id'] }}">
                                    <td colspan="10">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 fs-5 fw-bolder d-flex align-items-center">
                                                <i class="fas fa-bars icon-sort-platform me-3" style="display: none;"
                                                    aria-hidden="true"></i>
                                                @if ($pc['is_image_icon'])
                                                    <img src="{{ $pc['image'] }}" class="me-3" alt="{{ $pc['name'] }}"
                                                        style="width: 24px; height: 24px; object-fit: contain; border-radius: 4px;"
                                                        loading="lazy"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                                                    <i class="fas fa-image text-muted me-3"
                                                        style="display: none; font-size: 1.2rem;"
                                                        title="Không thể tải hình ảnh"></i>
                                                @else
                                                    <i class="{{ $pc['image'] }} me-3"
                                                        style="font-size: 1.2rem; color: #6c757d;" aria-hidden="true"></i>
                                                @endif
                                                <span class="ls-1">{{ $pc['name'] }}</span>
                                                <a href="javascript:;"
                                                    onclick="showModalUpdatePlatform({{ $pc['id'] }}, '{{ addslashes($pc['name']) }}', '{{ addslashes($pc['image']) }}')"
                                                    style="display: none;" class="a-update-platform"><i
                                                        class="bi bi-pencil fs-8 ms-2"></i></a>
                                            </div>
                                            <div data-status="Hide" class="text-end fs-8 show-hide pointer"
                                                style="border-bottom: 0.5px dashed"
                                                onclick="collapse(this, this.getAttribute('data-status'), {{ $pc['id'] }})">
                                                <span class="show-hide-text" data-page="common">Ẩn</span>
                                                ({{ $pc['category_count'] }})
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @forelse($pc['categories'] as $category)
                                    <tr class="tr-category {{ $category->status ? '' : 'text-muted' }}"
                                        data-id="{{ $category->id }}" data-status="{{ $category->status ? '1' : '0' }}"
                                        @if (!$category->status) style="opacity: 0.6;" @endif>
                                        <td width="1"><i class="fas fa-bars" aria-hidden="true"></i></td>
                                        <td width="1"><a href="javascript:;"
                                                onclick="showModalUpdateCategory('{{ base64_encode(json_encode($category->toArray())) }}')"><i
                                                    class="bi bi-pencil fs-8 1"></i></a></td>
                                        <td class="name wrap">{{ $category->name['en'] ?? $category->name }} @if (is_array($category->name) && count($category->name) > 1)
                                                <i class="fa-solid fa-language ms-2"></i>
                                            @endif
                                        </td>

                                        <td><i class="fa-solid fa-list-ul" data-bs-custom-class="tooltip-dark"
                                                data-bs-toggle="tooltip" data-bs-placement="top" aria-hidden="true"
                                                aria-label="Mặc định" data-bs-original-title="Mặc định"
                                                data-kt-initialized="1"></i><span class="sr-only">Mặc định</span></td>
                                        <td class="text-end" width="1">
                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input h-20px w-30px" type="checkbox"
                                                    value="{{ $category->id }}"
                                                    @if (intval($category->status) === 1) checked @endif
                                                    onchange="statusCategory(this.value, this.checked)">
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        @empty
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <!--Add Category-->

        <!--Update Category-->
        @include('adminpanel.category.create')

        <!--Add Platform-->
        @include('adminpanel.platform.create')
        @include('adminpanel.platform.update')

    </div>

    <style>
        #modal-platform .form-control:focus,
        #modal-platform .input-group-text:focus {
            box-shadow: none;
        }

        #modal-category .form-control:focus,
        #modal-category .input-group-text:focus {
            box-shadow: none;
        }

        .fullscreen-loader-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            backdrop-filter: blur(3px);
            z-index: 9998;
            animation: fadeIn 0.3s ease-in-out;
        }

        .fullscreen-loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            animation: slideUp 0.5s ease-out;
        }

        .fullscreen-loader-overlay.d-none,
        .fullscreen-loader.d-none {
            display: none !important;
        }

        .fullscreen-loader-overlay.fade-out,
        .fullscreen-loader.fade-out {
            animation: fadeOut 0.3s ease-in-out forwards;
        }


        /* Drag & Drop Styles */
        .sortable-ghost {
            opacity: 0.4;
            background: #f8f9fa !important;
        }

        .sortable-chosen {
            background: #e3f2fd !important;
        }

        .sortable-drag {
            background: #ffffff !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
            transform: rotate(2deg);
        }

        /* Platform sort icon styling */
        .icon-sort-platform {
            color: #6c757d;
            transition: all 0.2s ease;
        }

        .icon-sort-platform:hover {
            color: #495057;
            transform: scale(1.1);
        }

        /* Category sort icon styling */
        .tr-category td:first-child {
            /* Remove cursor grab */
        }

        .tr-category td:first-child:hover .fas.fa-bars {
            color: #495057;
            transform: scale(1.1);
        }

        .tr-category td:first-child:active {
            /* Remove cursor grabbing */
        }

        .tr-category .fas.fa-bars {
            color: #6c757d;
            transition: all 0.2s ease;
        }

        /* Platform row styling */
        .tr-platform.sortable-chosen {
            background: #e3f2fd !important;
        }

        /* Category row styling */
        .tr-category.sortable-chosen {
            background: #f0f8ff !important;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translate(-50%, calc(-50% + 20px));
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }
    </style>

    <!-- Category JS -->
    <script src="{{ asset('adminpanel/js/categories/index.js') }}" defer></script>
@endsection
