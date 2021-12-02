@extends('admin.dashboard')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <!--Header -->
            <h2 class="px-4 py-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Settings           
            </h2>                                       

            <!-- General elements -->
            <div class="px-4 py-3 mb-8 rounded-lg shadow-md">
                <form action="{{ route('admin.updateSettings')}}" method="post" >
                    @csrf
                    @method('PATCH')
                    <div>
                        <x-label for="about" :value="__('About')" />   
                        <textarea
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="30"
                        rows="10" name="about" placeholder="Add more to the about section..."
                        >{{ $setting->about }}</textarea>
                    </div>
                                        
                    <x-label for="Footer" :value="__('Footer')" class="text-gray-700 dark:text-gray-400"/>   
                    <textarea
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="30"
                        rows="8" name="footer"
                        placeholder="Add more to the footer....."
                    >{{ $setting->footer }}</textarea>

                    <x-label for="banner" :value="__('Banner')" class="text-gray-700 dark:text-gray-400"/>   
                    <textarea
                        class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" cols="30"
                        rows="5" name="banner"
                        placeholder="Describe the product....."
                    >{{ $setting->banner }}</textarea>

                    <button type="submit"
                        class="float-right px-4 py-2 mt-5 text-m font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Update
                    </button>
                </form>
 
            </div>         
        </div>
    </main>   
@endsection
