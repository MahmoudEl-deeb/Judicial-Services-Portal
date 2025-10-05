<div>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-8">
            <!-- Header Section -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold grey-dark-text mb-2">إدارة المستخدمين</h1>
                    <p class="text-lg grey-medium-text">إدارة وتتبع جميع مستخدمي النظام</p>
                </div>
                <div class="mt-4 lg:mt-0">
                    <button
                        class="gold-bg text-white px-6 py-3 rounded-xl font-bold hover:bg-gold-secondary transition-all duration-300 shadow-lg flex items-center">
                        <i class="fas fa-user-plus ml-2"></i>
                        إضافة مستخدم جديد
                    </button>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="bg-white rounded-2xl shadow-custom border border-gray-100 p-6 mb-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Name Filter -->
                    <div>
                        <label for="name" class="block text-sm font-bold grey-dark-text mb-2">البحث بالاسم</label>
                        <div class="relative">
                            <input wire:model.live="name" type="text" id="name"
                                class="w-full rounded-xl border border-gray-300 bg-white py-3 px-4 pr-10 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300"
                                placeholder="ابحث بالاسم...">
                            <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-bold grey-dark-text mb-2">الحالة</label>
                        <select wire:model.live="status" id="status"
                            class="w-full rounded-xl border border-gray-300 bg-white py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="">جميع الحالات</option>
                            <option value="active">نشط</option>
                            <option value="inactive">غير نشط</option>
                            <option value="pending">قيد الانتظار</option>
                            <option value="suspended">موقوف</option>
                        </select>
                    </div>

                    <!-- Role Filter -->
                    <div>
                        <label for="role" class="block text-sm font-bold grey-dark-text mb-2">الدور</label>
                        <select wire:model.live="role" id="role"
                            class="w-full rounded-xl border border-gray-300 bg-white py-3 px-4 text-gray-700 focus:outline-none focus:ring-2 focus:ring-gold-primary focus:border-gold-primary transition-all duration-300">
                            <option value="">جميع الأدوار</option>
                            @foreach ($arabicRoles as $key => $arabicName)
                                <option value="{{ $key }}">{{ $arabicName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mt-6 pt-6 border-t border-gray-200">
                    <div class="text-center p-3 bg-gray-50 rounded-xl">
                        <div class="text-xl font-bold grey-dark-text">{{ $statistics['totalUsers'] }}</div>
                        <div class="text-xs grey-medium-text">إجمالي المستخدمين</div>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded-xl">
                        <div class="text-xl font-bold text-green-600">{{ $statistics['activeUsers'] }}</div>
                        <div class="text-xs text-green-600">نشط</div>
                    </div>
                    <div class="text-center p-3 bg-teal-50 rounded-xl">
                        <div class="text-xl font-bold text-teal-600">{{ $statistics['clientUsers'] }}</div>
                        <div class="text-xs text-teal-600">مواطنون</div>
                    </div>
                    <div class="text-center p-3 bg-blue-50 rounded-xl">
                        <div class="text-xl font-bold text-blue-600">{{ $statistics['lawyerUsers'] }}</div>
                        <div class="text-xs text-blue-600">محامون</div>
                    </div>
                    <div class="text-center p-3 bg-purple-50 rounded-xl">
                        <div class="text-xl font-bold text-purple-600">{{ $statistics['adminUsers'] }}</div>
                        <div class="text-xs text-purple-600">مسؤولون</div>
                    </div>
                    <div class="text-center p-3 bg-orange-50 rounded-xl">
                        <div class="text-xl font-bold text-orange-600">{{ $statistics['pendingUsers'] }}</div>
                        <div class="text-xs text-orange-600">قيد الانتظار</div>
                    </div>
                    <div class="text-center p-3 bg-red-50 rounded-xl">
                        <div class="text-xl font-bold text-red-600">{{ $statistics['suspendedUsers'] }}</div>
                        <div class="text-xs text-red-600">موقوفون</div>
                    </div>

                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white rounded-2xl shadow-custom border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-[#2D3748] to-[#4A5568]">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-sm font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center justify-end">
                                        المستخدم
                                        <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-sm font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center justify-end">
                                        البريد الإلكتروني
                                        <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-sm font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center justify-end">
                                        الحالة
                                        <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-sm font-bold text-white uppercase tracking-wider">
                                    <div class="flex items-center justify-end">
                                        الأدوار
                                        <i class="fas fa-sort ml-2 text-gold-primary"></i>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="px-6 py-4 text-right text-sm font-bold text-white uppercase tracking-wider">
                                    الإجراءات
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gold-light transition-all duration-300 cursor-pointer">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center justify-end">
                                            <div class="ml-4 text-right">
                                                <div class="text-sm font-bold grey-dark-text">
                                                    {{ $user->first_name }} {{ $user->last_name }}
                                                </div>
                                                <div class="text-xs grey-light-text">
                                                    {{ $user->national_id }}
                                                </div>
                                            </div>
                                            <div
                                                class="w-10 h-10 user-avatar rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-right">
                                            <div class="text-sm grey-dark-text">{{ $user->email }}</div>
                                            <div class="text-xs grey-light-text">
                                                @if($user->email_verified_at)
                                                    <span class="text-green-600">✓ مفعل</span>
                                                @else
                                                    <span class="text-red-600">✗ غير مفعل</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusConfig = [
                                                'active' => ['bg-green-100', 'text-green-800', 'نشط'],
                                                'inactive' => ['bg-gray-100', 'text-gray-800', 'غير نشط'],
                                                'pending' => ['bg-yellow-100', 'text-yellow-800', 'قيد الانتظار'],
                                                'suspended' => ['bg-red-100', 'text-red-800', 'موقوف']
                                            ];
                                            $status = $statusConfig[$user->status] ?? ['bg-gray-100', 'text-gray-800', $user->status];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $status[0] }} {{ $status[1] }}">
                                            <span class="w-2 h-2 bg-current rounded-full ml-1"></span>
                                            {{ $status[2] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex flex-wrap gap-2 justify-end">
                                            @foreach($user->getRoleNames() as $role)
                                                @php
                                                    $roleConfig = [
                                                        'admin' => ['bg-purple-100', 'text-purple-800'],
                                                        'lawyer' => ['bg-blue-100', 'text-blue-800'],
                                                        'client' => ['bg-teal-100', 'text-teal-800'],
                                                        'user' => ['bg-gray-100', 'text-gray-800'],
                                                        'moderator' => ['bg-orange-100', 'text-orange-800']
                                                    ];
                                                    $roleStyle = $roleConfig[$role] ?? ['bg-gray-100', 'text-gray-800'];
                                                    $roleName = $arabicRoles[$role] ?? $role;
                                                @endphp
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $roleStyle[0] }} {{ $roleStyle[1] }}">
                                                    {{ $roleName }}
                                                </span>
                                            @endforeach
                                            @if($user->getRoleNames()->isEmpty())
                                                <span class="text-xs text-gray-500">لا يوجد أدوار</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-3 space-x-reverse">
                                            <a href="{{ route('admin.user.details', base64_encode($user->id)) }}"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-300 flex items-center"
                                                title="عرض التفاصيل">
                                                <i class="fas fa-eye ml-1"></i>
                                                عرض
                                            </a>
                                            <button
                                                class="text-yellow-600 hover:text-yellow-900 transition-colors duration-300 flex items-center"
                                                title="تعديل">
                                                <i class="fas fa-edit ml-1"></i>
                                                تعديل
                                            </button>
                                            <button
                                                class="text-red-600 hover:text-red-900 transition-colors duration-300 flex items-center"
                                                title="حذف">
                                                <i class="fas fa-trash ml-1"></i>
                                                حذف
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if($users->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                                            </div>
                                            <h3 class="text-lg font-medium grey-dark-text mb-2">لا توجد مستخدمين</h3>
                                            <p class="text-gray-500">لم يتم العثور على أي مستخدمين تطابق معايير البحث</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced Pagination -->
                @if($users->isNotEmpty())
                    <div class="px-6 py-4 bg-white border-t border-gray-200">
                        <div class="flex flex-col lg:flex-row items-center justify-between space-y-4 lg:space-y-0">
                            <div class="text-sm text-gray-700">
                                عرض
                                <span class="font-bold gold-text">{{ $users->firstItem() }}</span>
                                إلى
                                <span class="font-bold gold-text">{{ $users->lastItem() }}</span>
                                من
                                <span class="font-bold grey-dark-text">{{ $users->total() }}</span>
                                مستخدم
                            </div>

                            <div class="flex items-center space-x-2 space-x-reverse">
                                <!-- Custom Pagination Links -->
                                <nav class="flex items-center space-x-2 space-x-reverse">
                                    <!-- First Page -->
                                    @if($users->onFirstPage())
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-double-right"></i>
                                        </span>
                                    @else
                                        <a href="{{ $users->url(1) }}"
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                                    @endif

                                    <!-- Previous Page -->
                                    @if($users->onFirstPage())
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-right"></i>
                                        </span>
                                    @else
                                        <a href="{{ $users->previousPageUrl() }}"
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @endif

                                    <!-- Page Numbers -->
                                    @foreach($users->getUrlRange(max(1, $users->currentPage() - 2), min($users->lastPage(), $users->currentPage() + 2)) as $page => $url)
                                        @if($page == $users->currentPage())
                                            <span class="px-4 py-2 gold-bg text-white rounded-lg font-bold shadow-lg">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}"
                                                class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach

                                    <!-- Next Page -->
                                    @if($users->hasMorePages())
                                        <a href="{{ $users->nextPageUrl() }}"
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-left"></i>
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-left"></i>
                                        </span>
                                    @endif

                                    <!-- Last Page -->
                                    @if($users->hasMorePages())
                                        <a href="{{ $users->url($users->lastPage()) }}"
                                            class="px-3 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gold-light hover:border-gold-primary transition-all duration-300">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                    @else
                                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                            <i class="fas fa-angle-double-left"></i>
                                        </span>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .page-item.active .page-link {
            background-color: #D4AF37;
            border-color: #D4AF37;
            color: white;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-right: -1px;
            line-height: 1.25;
            color: #4A5568;
            background-color: #fff;
            border: 1px solid #E2E8F0;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            z-index: 2;
            color: #2D3748;
            text-decoration: none;
            background-color: #F7EFD8;
            border-color: #D4AF37;
        }
    </style>
</div>