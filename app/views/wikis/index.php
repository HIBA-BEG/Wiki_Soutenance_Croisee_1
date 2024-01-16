<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="flex justify-center">
    <!-- Open the modal using ID.showModal() method -->
    <?php if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'Author'): ?>
        <button class="btn h-6 flex items-center bg-pink-500 hover:bg-pink-600 text-white border-none m-6"
            onclick="addWiki.showModal()">+ Add Wiki +</button>
        <dialog id="addWiki" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Add a WIKI !!</h3>
                <div class="modal-action flex flex-col">
                    <form method="post" action="<?php echo URLROOT; ?>/wikis/add">
                        <!-- if there is a button in form, it will close the modal -->
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <label for="Title" class="text-black">Enter your title</label>
                                <input id="Title" name="Title" type="text" required
                                    class=" h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none border-dashed border-2 border-pink-600 <?php echo (!empty($data['Title_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                                    value="<?php echo $data['Title'] ?> " />
                                <span class="text-red-500">
                                    <?php echo $data['Title_err'] ?>
                                </span>
                                <label for="Content" class="text-black">Enter your content</label>
                                <input id="Content" name="Content" type="text" required
                                    class=" h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['Content_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                                    value="<?php echo $data['Content'] ?> " />
                                <span class="text-red-500">
                                    <?php echo $data['Content_err']; ?>
                                </span>
                                <label for="CategoryID" class="text-black">Choose category</label>
                                <div class="relative">
                                    <select name="CategoryID"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        required id="grid-state">
                                        <option value="">Choose category</option>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?= $category->CategoryID; ?>">
                                                <?= $category->CategoryName; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <label for="TagID" class="text-white">Choose Tags</label>
                                <div class="w-full">
                                    <label class="block text-lg font-semibold mb-2 text-black" for="grid-state-tags">
                                        Choose Your Tags
                                    </label>
                                    <div class="relative">
                                        <select name="tagname"
                                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-state-tags">
                                            <option value="">Sélectionnez un tag</option>
                                            <?php foreach ($data['tags'] as $tag): ?>
                                                <option value="<?= $tag->TagID; ?>">
                                                    <?= $tag->TagName; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" id="selected_tag_id" name="selected_tag_id" value="">
                                <div id="selected-tag-names"></div>
                                <button type="submit" value="add"
                                    class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">ADD</button>
                            </div>
                        </div>

                    </form>
                </div>
                <form method="dialog">
                      <button class="btn">Close</button>
                    </form>
            </div>
        </dialog>
    <?php endif; ?>
    <div class="relative m-6 ">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
            <input class="rounded-lg h-12 flex-1 px-9 py-4 text-pink-500 border-double border-4 border-pink-600 focus:outline-none " type="text" id="searchBar" placeholder="search.....">
    </div>
</div>


<div class="flex items-center">
    <!-- component -->
    <div class="flex flex-wrap py-10 p-14 gap-10" id="wikiContainerSearch"></div>
    <div class="flex flex-wrap py-10 p-14 gap-10" id="wikiContainer">
        <?php foreach ($data['wikis'] as $wiki): ?>
            <div class="max-w-2xl mx-auto">

                <div class="bg-purple-900 shadow-md border border-gray-200 rounded-lg max-w-sm">

                    <div class="p-5">
                        <a href="#">
                            <h5 class="text-white font-bold text-2xl tracking-tight mb-2">
                                Title:
                                <?php echo $wiki->Title ?>
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
                                <?php echo $wiki->CreationDate ?>
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
                            <p class="font-normal mb-3">Category:
                                <?= $wiki->CategoryName; ?>
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
                                <?php echo $wiki->LastModifiedDate ?>
                            </p>
                        </div>
                        <div class="flex justify-center p-2 flex-wrap">
                            <?php if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'Author'): ?>
                                    <button
                                        class="text-white bg-purple-400 hover:bg-purple-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 m-3 text-center inline-flex items-center"
                                        onclick="editWiki_<?php echo $wiki->WikiID ?>.showModal()">Update
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="-mr-1 ml-2 h-4 w-4"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                        </svg>
                                    </button>

                                <a href="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->WikiID; ?>"
                                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 m-3 text-center inline-flex items-center  ">
                                    Delete
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="-mr-1 ml-2 h-4 w-4"
                                        viewBox="0 0 448 512">
                                        <path
                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo URLROOT; ?>/wikis/archive/<?php echo $wiki->WikiID; ?>"
                                    class="text-white bg-purple-400 hover:bg-purple-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 m-3 text-center inline-flex items-center  ">
                                    Archiver
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="-mr-1 ml-2 h-4 w-4"
                                        viewBox="0 0 512 512">
                                        <path
                                            d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (isset($_SESSION['id_user']) && $_SESSION['role'] == 'Author'): ?>
        <?php foreach ($data['wikis'] as $wiki): ?>
        <dialog id="editWiki_<?php echo $wiki->WikiID ?>" class="modal">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Update a WIKI !!</h3>
                <div class="modal-action flex flex-col">
                    <form method="post" action="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->WikiID ?>">
                        <!-- if there is a button in form, it will close the modal -->
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <label for="Title" class="text-black">Enter your title</label>
                                <input id="Title" name="Title" type="text" required
                                    class=" h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none border-dashed border-2 border-pink-600 <?php echo (!empty($data['Title_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                                    value="<?php echo $wiki->Title?> " />
                                <span class="text-red-500">
                                    <?php echo $data['Title_err'] ?>
                                </span>
                                <label for="Content" class="text-black">Enter your content</label>
                                <input id="Content" name="Content" type="text" required
                                    class=" h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['Content_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                                    value="<?php echo $wiki->Content?> " />
                                <span class="text-red-500">
                                    <?php echo $data['Content_err']; ?>
                                </span>
                                <label for="CategoryID" class="text-black">Choose category</label>
                                <div class="relative">
                                    <select name="CategoryID"
                                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        required id="grid-state">
                                        <option value="<?= $wiki->CategoryID; ?>"><?= $wiki->CategoryName; ?></option>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?= $category->CategoryID; ?>">
                                                <?= $category->CategoryName; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-8 w-8" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                        </svg>
                                    </div>
                                </div>
                                <label for="TagID" class="text-white">Choose Tags</label>
                                <div class="w-full">
                                    <label class="block text-lg font-semibold mb-2 text-black" for="grid-state-tags">
                                        Choose Your Tags
                                    </label>
                                    <div class="relative">
                                        <select name="tagname"
                                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                            id="grid-state-tags">
                                            <option value="<?= $wiki->TagID; ?>"><?= $wiki->TagName; ?></option>
                                            <?php foreach ($data['tags'] as $tag): ?>
                                                <option value="<?= $tag->TagID; ?>">
                                                    <?= $tag->TagName; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" id="selected_tag_id" name="selected_tag_id" value="">
                                <div id="selected-tag-names"></div>
                                <button type="submit" value="edit"
                                    class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
                <form method="dialog">
                      <button class="btn">Close</button>
                    </form>
            </div>
        </dialog>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var selectedTagIds = [];

        function updateDisplayedTags() {
            var tagsContainer = document.getElementById("selected-tag-names");
            var selectedTagIdInput = document.getElementById("selected_tag_id");
            tagsContainer.innerHTML = "";

            selectedTagIds.forEach(function (tagId) {
                var tagName = getTagNameById(tagId);
                // Fonction pour récupérer le nom du tag
                var tag = document.createElement("span");
                tag.className = "selected-tag";
                tag.innerHTML = "<span class='bg-pink-500 text-white p-1 rounded-md m-1'>" + tagName + "</span><button class='text-red-500' data-tag-id=\"" + tagId + "\">Remove</button>";
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
            var tag = <?php echo json_encode($data['tags']); ?>;
            for (var i = 0; i < tag.length; i++) {
                if (tag[i].TagID == tagId) {
                    return tag[i].TagName;
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

</script>


<?php require APPROOT . '/views/inc/footer.php'; ?>