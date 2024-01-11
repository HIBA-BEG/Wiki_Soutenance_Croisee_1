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
  <!--==== frist div begins here ====--->
  <div class="container mr-5 ml-2 mx-auto bg-white shadow-xl">
    <div class="w-11/12 mx-auto">
      <div class="bg-white my-6">
        <table class="text-left w-full border-collapse">
          <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
          <thead class="bg-purple-400 ">
            <tr>
              <th class="py-4 px-6 font-bold uppercase text-sm text-white border-b border-grey-light">
                Category
              </th>
              <th class="py-4 px-6 text-center font-bold uppercase text-sm text-white border-b border-grey-light">
                <button
                  class=" lg:inline-block py-2 px-6 bg-pink-500 hover:bg-pink-600 text-sm text-white font-bold rounded-xl transition duration-200"
                  onclick="add.showModal()">Add
                </button>
                <dialog id="add" class="modal">
                  <div class="modal-box">
                    <h3 class="font-bold text-lg">Add a New Category</h3>
                    <div class="modal-action">
                      <form method="post" action="<?php echo URLROOT; ?>/categories/add">
                        <!-- if there is a button in form, it will close the modal -->
                        <div
                          class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 flex flex-col items-center justify-center">
                          <div class="relative">
                            <input placeholder="Enter your Category" id="CategoryName" name="CategoryName" type="text"
                              class="h-10 w-full border-b-2 border-gray-300 text-pink-600 focus:outline-none <?php echo (!empty($data['CategoryName_err'])) ? 'border-red-500 text-red-500' : 'border-none'; ?>"
                              value="<?php echo $data['CategoryName'] ?> " />
                            <span class="text-red-500">
                              <?php echo $data['CategoryName_err'] ?>
                            </span>
                          </div>
                          <button type="submit" value="add"
                            class="bg-pink-500 hover:bg-pink-600 text-white rounded-md px-2 py-1">ADD</button>
                        </div>
                      </form>
                      <button class="btn">Close</button>
                    </div>
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
                    class=" lg:inline-block py-2 px-6 bg-purple-500 hover:bg-purple-600 text-sm text-white font-bold rounded-xl transition duration-200">
                    Edit
                  </button>
                  <button
                    class=" lg:inline-block py-2 px-6 bg-red-500 hover:bg-red-600 text-sm text-white font-bold rounded-xl transition duration-200">
                    Delete
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--==== frist div ends here ====--->

  <!--==== Second div begins here ====--->
  <div class="container mr-5 mx-auto bg-white shadow-xl">
    <div class="w-11/12 mx-auto">
      <div class="bg-white my-6">
        <table class="text-left w-full border-collapse">
          <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
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
  </div>
  <!--==== Second div ends here ====--->

  <!--==== Third div begins here ====--->

  <!--==== Third div ends here ====--->
</div>
<!---------===================== SECOND ROW CONTAINING THE TABLE STATS ENDS HERE =============================-->


<?php require APPROOT . '/views/inc/footer.php'; ?>

<!-- bg-pink-500 hover:bg-pink-600 -->