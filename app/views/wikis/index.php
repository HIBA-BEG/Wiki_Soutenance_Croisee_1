<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

<div class="flex items-center">
    <!-- Open the modal using ID.showModal() method -->
    <button class="btn flex items-center bg-pink-500 hover:bg-pink-600 text-white border-none m-6" onclick="add.showModal()">+ Add Wiki +</button>
    <dialog id="add" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Add a WIKI !!</h3>
            <div class="modal-action">
                <form method="dialog" method="post" action="<?php echo URLROOT; ?>/wikis/add">
                    <!-- if there is a button in form, it will close the modal -->
					<div class="divide-y divide-gray-200">
						<div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
							<div class="relative">
								<input placeholder="Enter your title"  id="Title" name="Title" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['Title_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>" value="<?php echo $data['Title'] ?> "/>
								
								<span class="text-red-500">
									<?php echo $data['Title_err']; ?>
								</span>
							</div>
							<div class="relative">
								<input placeholder="text"  id="Content" name="Content" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['Content_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>" value="<?php echo $data['Content'] ?> "/>
								<span class="text-red-500">
									<?php echo $data['Content_err']; ?>
								</span>
							</div>
							<div class="relative">
								<input placeholder="Category ID"  id="CategoryID" name="CategoryID" type="text"
									class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['CategoryID_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>" value="<?php echo $data['CategoryID'] ?>"/>
								<span class="text-red-500">
									<?php echo $data['CategoryID_err']; ?>
								</span>
							</div>
							<div class="relative">
								<button type="submit" value="add"
									class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">ADD</button>
							</div>


						</div>
					</div>
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>
    <!-- component -->
    <div class="flex flex-wrap py-10 p-14 gap-10">
        <?php foreach ($data['wikis'] as $wiki): ?>
            <div class="max-w-2xl mx-auto">

                <div class="bg-purple-900 shadow-md border border-gray-200 rounded-lg max-w-sm">
                    <a href="#">
                        <img class="rounded-t-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="">
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="text-white font-bold text-2xl tracking-tight mb-2">
                                <?php echo $wiki->Title ?>
                            </h5>
                        </a>
                        <p class="font-normal text-white mb-3">
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
                        <div class="flex justify-center p-2 flex-wrap">
                            <a href="<?php echo URLROOT; ?>/wikis/edit/<?php echo $wiki->WikiID; ?>"
                                class="text-white bg-purple-400 hover:bg-purple-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 m-3 text-center inline-flex items-center  ">
                                Update
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="-mr-1 ml-2 h-4 w-4"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                </svg>
                            </a>
                            <a href="<?php echo URLROOT; ?>/wikis/delete/<?php echo $wiki->WikiID; ?>"
                                class="text-white bg-purple-400 hover:bg-purple-500 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 m-3 text-center inline-flex items-center  ">
                                Delete
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="-mr-1 ml-2 h-4 w-4"
                                    viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="max-w-2xl mx-auto">

            <div
                class="bg-white shadow-md border border-gray-200 rounded-lg max-w-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="https://flowbite.com/docs/images/blog/image-1.jpg" alt="">
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="text-gray-900 font-bold text-2xl tracking-tight mb-2 dark:text-white">Noteworthy
                            technology acquisitions 2021</h5>
                    </a>
                    <p class="font-normal text-gray-700 mb-3 dark:text-gray-400">Here are the biggest enterprise
                        technology
                        acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="#"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="-mr-1 ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>