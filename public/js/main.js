$(document).ready(function () {
    const currentPage = location.hre
    console.log(isAuthor)
    if (currentPage === 'http://localhost/Wiki_Soutenance_Croisee_1/wikis') {
        const search = document.querySelector('#searchBar')
        search.addEventListener('keyup', () => {
            const searchValue = search.value
            console.log(searchValue)
            $.ajax({
                url: `http://localhost/Wiki_Soutenance_Croisee_1/wikis/search//${searchValue}`,
                type: 'GET',
                success: function (data) {

                    const wikis = JSON.parse(data)
                    displayWikis(wikis)

                 },
            })
        })
    }
});


const displayWikis = (wikis) => {
    console.log(wikis);
    const container = document.querySelector('#wikiContainer')
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
                    Content:
                    <?php echo $wiki->Content ?>
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


    var selectedTagIds = [];

    function updateDisplayedTags() {
        var tagsContainer = document.getElementById("selected-tag-names");
        var selectedTagIdInput = document.getElementById("selected-tag-id");

        tagsContainer.innerHTML = "";

        selectedTagIds.forEach(function (tagId) {
            var tagName = getTagNameById(tagId); // Fonction pour récupérer le nom du tag
            var tag = document.createElement("span");
            tag.className = "selected-tag";
            tag.innerHTML = "<span class='bg-blue-500 text-white p-1 rounded-md m-1'>" + tagName + "</span><button class='text-red-500' data-tag-id=\"" + tagId + "\">Remove</button>";
            tagsContainer.appendChild(tag);

            // Attach the click event to the Remove button
            var removeButton = tag.querySelector("button");
            removeButton.addEventListener("click", removeTag);
        });

        selectedTagIdInput.value = JSON.stringify(selectedTagIds);
        console.log(selectedTagIdInput.value);
    }


    function getTagNameById(tagId) {
        // Fonction pour récupérer le nom du tag à partir du tableau de données des tags
        // var tag = <?php echo jso n_encode($data['tags']); ?>;
        console.log(tag);
        for (var i = 0; i < tag.length; i++) {
            if (tag[i].tag_id == tagId) {
                return tag[i].name;
            }
        }
        return "";
    }

    function removeTag(event) {
        var tagId = event.target.dataset.tagId;
        var index = selectedTagIds.indexOf(tagId);
        if (index !== -1) {
            selectedTagIds.splice(index, 1);
            updateDisplayedTags();
        }
    }

    // Event listener for the select element
    var selectElement = document.getElementById("grid-state-tags");
    selectElement.addEventListener("change", function () {
        var selectedTagId = selectElement.value;
        if (selectedTagId && !selectedTagIds.includes(selectedTagId)) {
            selectedTagIds.push(selectedTagId);
            updateDisplayedTags();
        }
    });



    
});
