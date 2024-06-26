<!DOCTYPE html>
<html lang="id">
@include('layouts.head')
@vite('resources/js/profile.js')
@vite('resources/css/profile.css')
<body class="relative">
    @include('layouts.nav')
    <div class="mt-[6.3rem] flex h-[85vh] relative" id="parent">
        <div class="w-1/2 bg-[#02a152]"></div>
        <div class="w-12/ bg-white"></div>
        
        <div class="absolute inset-0 flex justify-center items-center">
    
            <div class="flex border-[1px] rounded-md">
                <div class="min-w-[10rem] bg-[#6be790f8] py-[2rem] px-[4rem] items-center flex flex-col justify-center">
                    <div class="relative">
                        <div class="border-[3px] rounded-[50%] border-[#02a152]">
                        <img src="{{ url(Auth::user()->profile_picture_url) }}" alt="link to the storage" class="w-[10rem] h-[10rem] rounded-[50%] object-cover">
                        </div>
                         <button id="add-image-btn" class="text-white text-[18px] hover:text-[#ffd7d7] absolute bottom-0 right-[1rem]">
                            <img src="{{URL::asset('assets/add.png')}}" alt="">
                         </button>
                    </div>
                
                    <h2 class="mt-[1rem] text-center font-semibold text-[20px] text-[#1b1b1b]">{{auth()->user()->email}}</h2>
                    
                </div>
                <div class="min-w-[5rem] bg-white py-[2rem] px-[3rem] border-[1px]">
                    <h1 class="text-[30px] font-bold">Halo👋🏼,</h1>
                    <h2>{{auth()->user()->name}}</h2>

                    <button class="px-[1rem] py-[0.5rem] bg-[#02a152] rounded-md font-semibold text-white mt-[1rem] mb-[0.7rem] hover:bg-[#4dc98b] ease-in-out" id='edit-button'>
                        Sunting profile ✏️
                    </button>
                    <a href="" id="delete-acc">
                        <p class="text-red-600 underline decoration-red-600">Hapus akun</p>
                    </a>
                </div>
            </div>
        
        </div>
       
    </div>

     <!-- Edit popup -->
     <div id='popup' class="relative p-4 w-full max-w-md max-h-full z-100">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Ubah informasi personal
                </h3>
                <button id="popup-close" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="px-4 pb-4">
                <form class="space-y-4" action="{{route('profile.update')}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Username baru</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder={{auth()->user()->name}} />
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email baru </label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder={{auth()->user()->email}} />
                    </div>

                    <button type="submit" class="w-full text-white bg-[#02a152] hover:bg-[#46c787] focus:ring-4 focus:outline-none focus:ring-[#50dd97] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                   
                </form>
            </div>
        </div>
    </div>

     <!-- Image update popup -->
     <div id='image-popup' class="relative p-4 w-full max-w-md max-h-full z-100">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Ubah foto profil
                </h3>
                <button id="image-popup-close" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="px-4 pb-4">
                <form class="space-y-4" action="{{route('profile.editPfp')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Pilih foto: </label>
                        <input type="file" name="profile_picture_url" id="pfp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Pilih foto" required/>
                    </div>

                    <button type="submit" class="w-full text-white bg-[#02a152] hover:bg-[#46c787] focus:ring-4 focus:outline-none focus:ring-[#50dd97] font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                   
                </form>
            </div>
        </div>
    </div>
    
    <!-- Form untuk delete account -->
    <form id="delete-account-form" action="{{ route('profile.destroy') }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    
    
@include('layouts.footer')
@if(session('success'))
    <script>
        window.onload = function() {
            alert("{{ session('success') }}");
        }
    </script>
@endif
</body>

</html>