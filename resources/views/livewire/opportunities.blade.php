<div class="min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Opportunities</h1>
                    <p class="mt-1 text-sm text-gray-500">Manage and track your opportunities</p>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <!-- Search with debounce -->
                    <div class="relative">
                        <input 
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search opportunities..."
                            class="w-full sm:w-72 pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Items per page -->
                    <div class="flex items-center gap-2">
                        <label for="perPage" class="text-sm font-medium text-gray-700">Show:</label>
                        <select 
                            wire:model.live="perPage" 
                            id="perPage" 
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                        >
                            @foreach($options as $option)
                                <option value="{{ $option }}">{{ $option }} items</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div wire:loading.delay class="w-full">
            <div class="animate-pulse bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="h-4 bg-gray-200 rounded-full w-1/4 mb-4"></div>
                <div class="space-y-3">
                    <div class="h-4 bg-gray-200 rounded-full"></div>
                    <div class="h-4 bg-gray-200 rounded-full w-5/6"></div>
                </div>
            </div>
        </div>

        <!-- Items List -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="border-b border-gray-200">
                <div class="px-6 py-4 bg-gray-50">
                    <button 
                        wire:click="sortBy('name')" 
                        class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors"
                    >
                        <span>Name</span>
                        @if($sortField === 'name')
                            <span class="text-blue-600">
                                @if($sortDirection === 'asc')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                    </svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                @endif
                            </span>
                        @endif
                    </button>
                </div>
            </div>

            <div class="divide-y divide-gray-200" wire:loading.class="opacity-50">
                @if($items->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 px-4">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No items found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filters</p>
                    </div>
                @else
                    @foreach($items as $item)
                        <div 
                            wire:key="{{ $item->id }}" 
                            class="px-6 py-4 hover:bg-gray-50 transition-colors duration-150 ease-in-out"
                        >
                            <div class="flex items-center justify-between">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $item->name }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="text-gray-400 hover:text-blue-600 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $items->links() }}
        </div>
    </div>
</div>