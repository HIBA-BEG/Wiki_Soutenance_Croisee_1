<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>


<!-- component -->
<div class="flex flex-wrap py-10 p-14 gap-10">
    <div class="flex flex-wrap py-10 p-14 gap-10" id="wikiContainer">
        <?php foreach ($data['wikis'] as $wiki):
            $wikitags = $wiki->wikitag;
            ?>
            <div class="max-w-2xl mx-auto">

                <div class="bg-purple-900 shadow-md border border-gray-200 rounded-lg max-w-sm">

                    <div class="p-5">
                        <a href="#">
                            <h5 class="text-white font-bold text-2xl tracking-tight mb-2">
                                Title:
                                <?php echo $wiki->Title ?>
                            </h5>
                        </a>
                        <p class="truncate font-normal text-white mb-3">
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
                        <div>
                            <?php foreach ($wikitags as $wikitag): ?>
                                <div
                                    class="text-xs inline-flex items-center font-bold leading-sm px-3 py-1 bg-blue-200 text-mr px-4 py-1  rounded-full gap-1">
                                    <span>#</span>
                                    <p>
                                        <?= $wikitag->TagName; ?>
                                    </p>

                                </div>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?php echo URLROOT; ?>/wikis/oneWiki/<?php echo $wiki->WikiID; ?>"
                            class="font-normal underline text-white mb-3">See more</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>