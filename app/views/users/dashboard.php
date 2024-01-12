<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar.php'; ?>


<!---===================== FIRST ROW CONTAINING THE  STATS CARD STARTS HERE =============================-->
<div class="flex flex-wrap py-10 p-14 gap-10">
  <!---== First Stats Container ====--->
  <div class=" max-w-2xl m-auto">
    <div
      class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
      <div class="h-20 bg-red-400 flex items-center justify-between">
        <p class="mr-0 text-white text-lg pl-5">Authors</p>
      </div>
      <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
        <p>TOTAL</p>
      </div>
      <p class="py-4 text-3xl ml-5">
        <?php echo $data['total_users'] ?>
      </p>
      <!-- <hr > -->
    </div>
  </div>
  <!---== First Stats Container ====--->

  <!---== Second Stats Container ====--->
  <div class=" max-w-2xl m-auto">
    <div
      class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
      <div class="h-20 bg-blue-500 flex items-center justify-between">
        <p class="mr-0 text-white text-lg pl-5">Categories</p>
      </div>
      <div class="flex justify-between px-5 pt-6 mb-2 text-sm text-gray-600">
        <p>TOTAL</p>
      </div>
      <p class="py-4 text-3xl ml-5">
        <?php echo $data['total_categories'] ?>
      </p>
      <!-- <hr > -->
    </div>
  </div>
  <!---== Second Stats Container ====--->

  <!---== Third Stats Container ====--->
  <div class=" max-w-2xl m-auto">
    <div
      class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
      <div class="h-20 bg-purple-400 flex items-center justify-between">
        <p class="mr-0 text-white text-lg pl-5">Wikis</p>
      </div>
      <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
        <p>TOTAL</p>
      </div>
      <p class="py-4 text-3xl ml-5">
        <?php echo $data['total_wikis'] ?>
      </p>
      <!-- <hr > -->
    </div>
  </div>
  <!---== Third Stats Container ====--->

  <!---== Fourth Stats Container ====--->
  <div class=" max-w-2xl m-auto">
    <div
      class="w-72 bg-white max-w-xs mx-auto rounded-sm overflow-hidden shadow-lg hover:shadow-2xl transition duration-500 transform hover:scale-100 cursor-pointer">
      <div class="h-20 bg-purple-900 flex items-center justify-between">
        <p class="mr-0 text-white text-lg pl-5">Tags</p>
      </div>
      <div class="flex justify-between pt-6 px-5 mb-2 text-sm text-gray-600">
        <p>TOTAL</p>
      </div>
      <p class="py-4 text-3xl ml-5">
        <?php echo $data['total_tags'] ?>
      </p>
      <!-- <hr > -->
    </div>
  </div>
  <!---== Fourth Stats Container ====--->
</div>
<!---===================== FIRST ROW CONTAINING THE  STATS CARD ENDS HERE =============================-->

<!------===================== SECOND ROW CONTAINING THE TABLE STATS STARTS HERE =============================-->
<div class="flex justify-center py-10 p-5">

  <!--==== CATEGORIES DIV ====--->
  <div class="container mr-5 ml-2 mx-auto bg-white shadow-xl">
    <div class="w-11/12 mx-auto">
      <div class="bg-white my-6">
        <table class="text-left w-full border-collapse">
          <thead class="bg-purple-400 ">
            <tr>
              <th class="py-4 px-6 font-bold uppercase text-sm text-white border-b border-grey-light">
                Category
              </th>
              <th class="py-4 px-6 text-center font-bold uppercase text-sm text-white border-b border-grey-light">
                <button
                  class=" lg:inline-block py-2 px-6 bg-pink-500 hover:bg-pink-600 text-sm text-white font-bold rounded-xl transition duration-200"
                  onclick="addCategory.showModal()">Add
                </button>
                <dialog id="addCategory" class="modal">
                  <div class="modal-box">
                    <h3 class="font-bold text-lg">Add a New Category</h3>
                    <div class="modal-action flex flex-col">
                      <form method="post" action="<?php echo URLROOT; ?>/categories/add">
                        <div
                          class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 items-center justify-center">
                          <input placeholder="Enter your Category" id="CategoryName" name="CategoryName" type="text"
                            class="h-10 w-full pr-8 border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['CategoryName_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                            value="<?php echo $data['CategoryName'] ?> " />
                          <span class="text-red-500">
                            <?php echo $data['CategoryName_err'] ?>
                          </span>
                          <button type="submit" value="add"
                            class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">ADD</button>
                        </div>
                      </form>
                    </div>
                    <form method="dialog">
                      <button class="btn">Close</button>
                    </form>
                  </div>
                </dialog>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['categories'] as $category): ?>
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">
                  <?php echo $category->CategoryID ?>
                </td>
                <td class="py-4 px-6 text-center border-b border-grey-light">
                  <?php echo $category->CategoryName ?>
                </td>
                <td class="py-4 px-6 text-center border-b border-grey-light">
                  <button
                    class=" lg:inline-block py-2 px-6 bg-purple-500 hover:bg-purple-600 text-sm text-white font-bold rounded-xl transition duration-200"
                    onclick="editCategory_<?php echo $category->CategoryID ?>.showModal()">Edit
                  </button>
                  <a href="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->CategoryID; ?>">
                    <button
                      class=" lg:inline-block py-2 px-6 bg-red-500 hover:bg-red-600 text-sm text-white font-bold rounded-xl transition duration-200">
                      Delete
                    </button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tr>
          </tbody>
        </table>

        <?php foreach ($data['categories'] as $category): ?>
          <dialog id="editCategory_<?php echo $category->CategoryID ?>" class="modal">
            <div class="modal-box">
              <h3 class="font-bold text-lg">Edit the Category</h3>
              <div class="modal-action flex flex-col">
                <form method="post" action="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->CategoryID ?>">
                  <div
                    class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 items-center justify-center">
                    <input placeholder="Enter your Category" id="CategoryName" name="CategoryName" type="text"
                      class="h-10 w-full pr-8 border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['CategoryName_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                      value="<?php echo $category->CategoryName ?> " />
                    <span class="text-red-500">
                      <?php echo $data['CategoryName_err'] ?>
                    </span>
                    <button type="submit" 
                      class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">EDIT</button>
                  </div>
                </form>
              </div>
              <form method="dialog">
                <button class="btn">Close</button>
              </form>
            </div>
          </dialog>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!--==== DIV ends ====--->
  
  <!--==== TAGS DIV ====--->
  <div class="container mr-5 ml-2 mx-auto bg-white shadow-xl">
    <div class="w-11/12 mx-auto">
      <div class="bg-white my-6">
        <table class="text-left w-full border-collapse">
          <thead class="bg-purple-400 ">
            <tr>
              <th class="py-4 px-6 font-bold uppercase text-sm text-white border-b border-grey-light">
                Tag
              </th>
              <th class="py-4 px-6 text-center font-bold uppercase text-sm text-white border-b border-grey-light">
                <button
                  class=" lg:inline-block py-2 px-6 bg-pink-500 hover:bg-pink-600 text-sm text-white font-bold rounded-xl transition duration-200"
                  onclick="addTag.showModal()">Add
                </button>
                <dialog id="addTag" class="modal">
                  <div class="modal-box">
                    <h3 class="font-bold text-lg">Add a New Tag</h3>
                    <div class="modal-action flex flex-col">
                      <form method="post" action="<?php echo URLROOT; ?>/tags/add">
                        <!-- if there is a button in form, it will close the modal -->
                        <div
                          class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 items-center justify-center">
                          <input placeholder="Enter your Tag" id="TagName" name="TagName" type="text"
                            class="h-10 w-full pr-8 border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['TagName_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                            value="<?php echo $data['TagName'] ?>" />
                          <span class="text-red-500">
                            <?php echo $data['TagName_err'] ?>
                          </span>
                          <button type="submit"
                            class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">ADD</button>
                        </div>
                      </form>
                    </div>
                    <form method="dialog">
                      <button class="btn">Close</button>
                    </form>
                  </div>
                </dialog>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($data['tags'] as $tag): ?>
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">
                  <?php echo $tag->TagID ?>
                </td>
                <td class="py-4 px-6 text-center border-b border-grey-light">
                  <?php echo $tag->TagName ?>
                </td>
                <td class="py-4 px-6 text-center border-b border-grey-light">
                  <button
                    class=" lg:inline-block py-2 px-6 bg-purple-500 hover:bg-purple-600 text-sm text-white font-bold rounded-xl transition duration-200"
                    onclick="editTag_<?php echo $tag->TagID ?>.showModal()">Edit
                  </button>
                  <a href="<?php echo URLROOT; ?>/tags/delete/<?php echo $tag->TagID; ?>">
                    <button
                      class=" lg:inline-block py-2 px-6 bg-red-500 hover:bg-red-600 text-sm text-white font-bold rounded-xl transition duration-200">
                      Delete
                    </button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tr>
          </tbody>
        </table>

        <?php foreach ($data['tags'] as $tag): ?>
          <dialog id="editTag_<?php echo $tag->TagID ?>" class="modal">
            <div class="modal-box">
              <h3 class="font-bold text-lg">Edit the Tag</h3>
              <div class="modal-action flex flex-col">
                <form method="post" action="<?php echo URLROOT; ?>/tags/edit/<?php echo $tag->TagID ?>">
                  <!-- if there is a button in form, it will close the modal -->
                  <div
                    class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 items-center justify-center">
                    <input placeholder="Enter your Tag" id="TagName" name="TagName" type="text"
                      class="h-10 w-full pr-8 border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['TagName_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                      value="<?php echo $tag->TagName ?> " />
                    <span class="text-red-500">
                      <?php echo $data['TagName_err'] ?>
                    </span>
                    <button type="submit" 
                      class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">EDIT</button>
                  </div>
                </form>
              </div>
              <form method="dialog">
                <button class="btn">Close</button>
              </form>
            </div>
          </dialog>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!--==== frist div ends here ====--->

  <!--==== Second div begins here ====--->
  <!-- <div class="container mr-5 mx-auto bg-white shadow-xl">
    <div class="w-11/12 mx-auto">
      <div class="bg-white my-6">
        <table class="text-left w-full border-collapse">
          <thead>
            <tr>
              <th class="py-4 px-6 bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                MSISDN</th>
              <th
                class="py-4 px-6 text-center bg-purple-400 font-bold uppercase text-sm text-white border-b border-grey-light">
                ENTRIES</th>
            </tr>
          </thead>
          <tbody>
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">26809304030</td>
              <td class="py-4 px-6 text-center border-b border-grey-light">
                495,455
              </td>
            </tr>
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">26809304030</td>
              <td class="py-4 px-6 text-center border-b border-grey-light">
                495,455
              </td>
            </tr>
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">26809304030</td>
              <td class="py-4 px-6 text-center border-b border-grey-light">
                495,455
              </td>
            </tr>
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">26809304030</td>
              <td class="py-4 px-6 text-center border-b border-grey-light">
                32,333
              </td>
            </tr>
            <tr class="hover:bg-grey-lighter">
              <td class="py-4 px-6 border-b border-grey-light">26809304030</td>
              <td class="py-4 px-6 text-center border-b border-grey-light">
                31,199
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div> -->
  <!--==== Second div ends here ====--->

</div>
<!---------===================== SECOND ROW CONTAINING THE TABLE STATS ENDS HERE =============================-->


<?php require APPROOT . '/views/inc/footer.php'; ?>

<!-- bg-pink-500 hover:bg-pink-600 -->