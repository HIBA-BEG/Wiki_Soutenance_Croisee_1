<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>

  
<!-- component -->
<div class="flex flex-wrap py-10 p-14 gap-10">

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
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
