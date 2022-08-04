<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="columns-2 ...">
                        @if(Session::has('status'))
                            <div class="alert alert-danger">
                                {{ Session::get('status')}}
                            </div>
                        @endif
                        <div class="container mx-auto">
                            <h2 class="font-semibold text-lg">
                                Upload contacts
                            </h2>
                            <div>
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    
                                    <div class="mt-5 md:mt-0 md:col-span-3">
                                    <form action="{{ url('addcats') }}" method="POST">
                                        @csrf
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <div class="grid grid-cols-1 w-full">
                                                <div class="col-span-3 sm:col-span-2">
                                                    <label for="company-website" class="block text-sm font-medium text-gray-700"> Category </label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm"> CATS: </span>
                                                    <input type="text"  id="category" name="cats" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Categories">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save category</button>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container mx-auto">
                            <h2 class="font-semibold text-lg">
                                Uploaded contacts
                            </h2>
                            <div>
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    
                                    <div class="mt-5 md:mt-0 md:col-span-3">
                                    <form action="{{ url('contact') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <label class="block text-sm font-medium text-gray-700"> Categories </label>
                                            <select id="country" name="category_id" autocomplete="country-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->category }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700"> Contacts CSV </label>
                                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                    <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600">
                                                        <label for="file-upload"  class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                        <span>Upload a file</span>
                                                        <input id="file-upload" name="file" type="file" class="sr-only">
                                                        </label>
                                                        <p class="pl-3">or drag and drop</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">CSV or excel file up to 10MB</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save contacts</button>
                                        </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
