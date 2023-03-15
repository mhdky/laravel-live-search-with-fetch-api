<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Cara Membuat Fitur Live Search Pada Laravel Dengan Fetch API Javascript</title>
</head>
<body>
    <div class="w-[90%] mx-auto mt-10">
        {{-- buat input dengan nama class search-input --}}
        <input type="text" class="search-input bg-transparent w-full flex-[2] border border-zinc-400 px-2 py-1 rounded-md">
    
        {{-- kontainer untuk menampung data hasil pencarian  --}}
        <div class="w-full h-[60vh] mt-5 border border-zinc-500 rounded-md overflow-auto">            
            {{-- loading --}}
            <p class="loading w-full h-full hidden justify-center items-center">Memuat...</p>

            {{-- tampilan dari pencarian --}}
            {{-- <a href="#" class="w-full p-3 inline-block hover:bg-zinc-200">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias, ut.</a>
            <a href="#" class="w-full p-3 inline-block hover:bg-zinc-200">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias, ut.</a>
            <a href="#" class="w-full p-3 inline-block hover:bg-zinc-200">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias, ut.</a> --}}
            
            {{-- class search-results untuk menampilkan data hasil pencarian --}}
            <div class="search-results"></div>
        </div>
    </div>

    <script>
        // tangkap class search-input
        const searchInput = document.querySelector('.search-input');
        // tangkap class search-results
        const searchResults = document.querySelector('.search-results');
        // tangkap class loading
        const loading = document.querySelector('.loading');

        // jalankan event ketika kata kunci dimasukan
        searchInput.addEventListener('keyup', (e) => {
            // trim() untuk menghapus awal spasi dan akhir spasi
            const searchText = e.target.value.trim();


            if (searchText.length > 0) {
                // Tampilkan loading
                loading.style.display = 'block';

                fetch(`/search/${searchText}`)
                    .then(response => response.json())
                    .then(data => {
                        // Sembunyikan loading
                        loading.style.display = 'none';

                        searchResults.innerHTML = '';

                        if (data.length === 0) {
                            // Jika data tidak ditemukan, tampilkan pesan
                            const notFound = document.createElement('div');
                            notFound.classList.add('w-full', 'h-full', 'flex', 'justify-center', 'items-center');
                            notFound.textContent = 'Postingan tidak ditemukan';
                            searchResults.appendChild(notFound);
                        } else {
                            data.forEach(post => {
                                // jika data ditemukan
                                const link = document.createElement('a');
                                link.href = `${post.slug}`;
                                link.classList.add('w-full', 'p-3', 'inline-block', 'hover:bg-zinc-200');
                                link.textContent = post.title;

                                searchResults.appendChild(link);
                            });
                        }
                    })
                    // jika request gagal
                    .catch(error => console.log(error));
            } else {
                loading.style.display = 'none';
                searchResults.innerHTML = '';
            }
        });
    </script>
</body>
</html>