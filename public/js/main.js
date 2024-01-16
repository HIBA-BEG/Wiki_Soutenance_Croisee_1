$(document).ready(function () {
    const currentPage = location.href
    // console.log(isAuthor)
    if (currentPage === 'http://localhost/Wiki_Soutenance_Croisee_1/wikis') {
        const search = document.querySelector('#searchBar')
        search.addEventListener('keyup', () => {
            const searchValue = search.value
            console.log(searchValue)
    
            if (searchValue != "") {
                $.ajax({
                    url: `http://localhost/Wiki_Soutenance_Croisee_1/wikis/search/${searchValue}`,
                    type: 'GET',
                    success: function (data) {
                        const wikis = JSON.parse(data)
                        displayWikis(wikis)
                     },
                     error: function(status, error) {
                        console.error('Error fetching tasks:', status, error);
                    }
                });
                $("#wikiContainer").hide();
                $("#wikiContainerSearch").show()
    
            } else {
                $("#wikiContainer").show();
                $("#wikiContainerSearch").hide()
    
            }
    
        })
    }
});


const displayWikis = (wikis) => {
    console.log(wikis);
    const container = document.querySelector('#wikiContainerSearch')
    container.innerHTML = ""

    wikis.forEach(wiki => {
        container.innerHTML += `
        <div class="max-w-2xl mx-auto">

        <div class="bg-purple-900 shadow-md border border-gray-200 rounded-lg max-w-sm">
            
            <div class="p-5">
                <a href="#">
                    <h5 class="text-white font-bold text-2xl tracking-tight mb-2">
                        Title: ${wiki.Title}
                    </h5>
                </a>
                <p class="font-normal text-white mb-3">
                    Content: ${wiki.Content}
                </p>
                <div class="flex space-x-2 text-white text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="font-normal mb-3">created on:
                        ${wiki.CreationDate}
                    </p>
                </div>
                <div class="flex space-x-2 text-white text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="font-normal mb-3" value="<?= $wiki->CategoryID; ?>">Category:
                        ${wiki.CategoryName}
                    </p>
                </div>
                <div class="flex space-x-2 text-white text-sm">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p class="font-normal mb-3">Last modified:
                         ${wiki.LastModifiedDate}
                    </p>
                </div>
                <div class="flex justify-center p-2 flex-wrap">
                   
                </div>
            </div>
        </div>
    </div>
        
        `
    })
}

document.addEventListener('DOMContentLoaded', function () {
    // Burger menus

    // open
    const burger = document.querySelectorAll('.navbar-burger');
    const menu = document.querySelectorAll('.navbar-menu');

    if (burger.length && menu.length) {
        for (var i = 0; i < burger.length; i++) {
            burger[i].addEventListener('click', function () {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    // close
    const close = document.querySelectorAll('.navbar-close');
    const backdrop = document.querySelectorAll('.navbar-backdrop');

    if (close.length) {
        for (var i = 0; i < close.length; i++) {
            close[i].addEventListener('click', function () {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    if (backdrop.length) {
        for (var i = 0; i < backdrop.length; i++) {
            backdrop[i].addEventListener('click', function () {
                for (var j = 0; j < menu.length; j++) {
                    menu[j].classList.toggle('hidden');
                }
            });
        }
    }

    
});
