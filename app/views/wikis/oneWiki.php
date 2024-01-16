<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<?php 
$wiki=$data["wikis"]; 
$wikitags=$wiki["wikitag"]; 
?>
<div class="">

<div class=" w-1/2 m-auto mt-10 p-6 bg-white rounded-lg shadow-md">
<a href="<?= URLROOT ?>/wikis" title="Back to home page" class="p-2">
            <svg xmlns="http://www.w3.org/2000/svg" height="30" width="30" viewBox="0 0 448 512">
                <path fill="#2d2522" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
            </svg>
        </a>
    <!-- component -->
    <div class="w-full" id="wikiContainer">
   
            <!-- $wikitags= $wiki->wikitag; ?> -->
            <div class=" ">

                <div class="bg-purple-900 shadow-md border border-gray-200 rounded-lg w-full">

                    <div class="p-5">
                        <a href="#">
                            <h5 class="text-white font-bold text-2xl tracking-tight mb-2">
                                Title:
                                <?php echo $wiki['Title']?>
                                
                            </h5>
                        </a>
                        <p class="font-normal text-white mb-3">
                            Content:
                            <?php echo $wiki['Content'] ?>
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
                                <?php echo $wiki['CreationDate'] ?>
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
                                <?= $wiki['CategoryName']; ?>
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
                                <?php echo $wiki['LastModifiedDate'] ?>
                            </p>

                            
                        </div>
                        <div>
                            <?php foreach ($wikitags as $wikitag): ?>
                       <div class="text-xs inline-flex items-center font-bold leading-sm px-3 py-1 bg-blue-200 text-mr px-4 py-1  rounded-full gap-1">
                            <span>#</span>
                            <p><?= $wikitag->TagName; ?></p>

                        </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    

</div>
                            </div>



<?php require APPROOT . '/views/inc/footer.php'; ?>