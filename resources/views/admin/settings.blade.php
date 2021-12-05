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
                        <x-textarea :value="$setting->about" name="about" rows="7" cols="30" placeholder="Update about section......"  />
                    </div>
                                        
                    <x-label for="Footer" :value="__('Footer')" class="text-gray-700 dark:text-gray-400"/>   
                    <x-textarea :value="$setting->footer" name="footer" rows="5" cols="30" placeholder="Update footer section......"  />

                    <x-label for="banner" :value="__('Banner')" class="text-gray-700 dark:text-gray-400"/>   
                    <x-textarea :value="$setting->banner" name="banner" rows="3" cols="30" placeholder="Update banner section......"  />
                    
                    <div class="flex flex-row justify">
                        <div class="mr-5 w-1/2">
                            <x-label for="coupon" :value="__('Coupon')" class="text-gray-700 dark:text-gray-400"/>   
                            <x-textarea :value="$setting->coupon" name="coupon" rows="3" cols="15" placeholder="Update Coupon code......"  />
                        </div>
                        <div class="w-1/2">
                            <x-label for="tax" :value="__('Tax')" class="text-gray-700 dark:text-gray-400"/>   
                            <input type="number" name="tax" value="{{$setting->tax}}" class="w-full h-auto">
                        </div>                      
                    </div>




                    <button type="submit"
                        class="float-right px-4 py-2 mt-5 text-m font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Update
                    </button>
                </form>
 
            </div>         
        </div>
    </main>   
@endsection
