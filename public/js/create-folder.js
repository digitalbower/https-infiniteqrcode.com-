$(document).ready(function () {
  // Toggle dropdown visibility
  $("#folderDropdownButton").click(function () {
    $("#folderDropdown").toggleClass("hidden");
  });
  $("#folderList").on("click", "li", function () {
    const selectedText = $(this).text().trim(); // Get folder name
    $("#selectedFolder").text(selectedText); // Update button text
    $("#folderinput").val(selectedText); // Set hidden input value
    $("#folderDropdown").addClass("hidden"); // Close dropdown
  });
  // Select a folder
  $("#folderList").on("click", "li:not(.new-folder-input)", function () {
    const selectedText = $(this).text().trim(); // Get folder name
    $("#selectedFolder").text(selectedText); // Update button text
    $("#folderinput").val(selectedText); // Set hidden input value
    $("#folderDropdown").addClass("hidden"); // Close dropdown
  });
  $("#addFolderButton").click(function () {
    const folderCount = $("#folderList li").length; // Count current folders
    if (folderCount >= 5) {
      alert("You can only create up to 5 folders.");
    } else {
      // Remove existing input if present
      $("#folderList .new-folder-input").remove();
      // Add new input field
      const newInput = `
        <li class="new-folder-input p-2 flex items-center">
          <input
            type="text"
            class="w-full border border-gray-300 rounded p-2"
            placeholder="Enter folder name"
            id="newFolderInput"
          /><button
                                id="FolderB" type="button"
                                class="w-full text-green-500  font-semibold py-2 hover:bg-green-100 p-2 flex items-center justify-center" disabled>
                                    Create 
                              </button>
        </li>`;
      $("#folderList").append(newInput);
      $("#newFolderInput").focus(); // Focus on the input
    }
  });
  $("#FolderB").on("click", function () {
  const folderName = $("#FolderB").val().trim(); // Get the value from #FolderB
  const newFolderInput = $("#folderList .new-folder-input");
  if (folderName && newFolderInput.val().trim() !== "") {
    if (isFolderNameExists(folderName)) {
      alert("A folder with this name already exists!");
      $("#FolderB").val(""); // Clear the input field
      return;
    }
    // Create new folder item
    const folderItem = `
      <li class="p-2 text-gray-600 flex items-center cursor-pointer hover:bg-gray-100">
        <span>${folderName}</span>
      </li>`;
    // Replace input with folder item
    newFolderInput.replaceWith(folderItem);
    // Update the selected folder and close the dropdown
    $("#selectedFolder").text(folderName);
    $("#folderinput").val(folderName);
    $("#folderDropdown").addClass("hidden"); // Close dropdown
  } else {
    if (newFolderInput.val().trim() === "") {
      alert("Folder name cannot be empty!");
      newFolderInput.remove(); // Remove the input field if empty
    }
  }
});
  $("#folderList").on("change", "#newFolderInput", function (e) {
    //if (e.which === 13) {
    // Enter key
    
    const folderName = $("#newFolderInput").val().trim();
    if (folderName!='') {
      if (isFolderNameExists(folderName)) {
        alert("A folder with this name already exists!");
        $(this).val(""); // Clear the input
        return;
      }
      // Create new folder item
      const folderItem = `
          <li class="p-2 text-gray-600 flex items-center cursor-pointer hover:bg-gray-100">
            <span>${folderName}</span>
          </li>`;
      // Add new folder and remove the input
      $("#folderList .new-folder-input").replaceWith(folderItem);
      // Set the newly added folder as selected
      $("#selectedFolder").text(folderName);
      $("#folderinput").val(folderName);
      $("#folderDropdown").addClass("hidden"); // Close dropdown
    } else {
      alert("Folder name cannot be empty!");
      $("#folderList .new-folder-input").remove(); // Remove input if empty
    }
    //}
  });
  // Prevent editing once a folder is selected
  $("#folderList").on("click", "li:not(.new-folder-input)", function () {
    // Prevent editing: do nothing except selection
    const selectedText = $(this).text().trim();
    $("#selectedFolder").text(selectedText);
    $("#folderinput").val(selectedText);
    $("#folderDropdown").addClass("hidden");
  });
  // Prevent closing the dropdown if input is clicked
  $(document).on("click", "li", function (event) {
   
      const newFolderInput = $("#newFolderInput");
      // If new folder input is not focused or doesn't exist
      if (!newFolderInput.length || !newFolderInput.is(":focus")) {
        $("#folderList .new-folder-input").remove();
        // Uncomment this line if you want to hide the dropdown
        // $("#folderDropdown").addClass("hidden");
      } else {
        // Alert if the input field is empty
        if (newFolderInput.val().trim()=='') {
          alert("Folder name cannot be empty!");
        }
      }
    
  });
  $(document).on("click", function (event) {
    const isDropdownButton = $(event.target).closest("#folderDropdownButton").length;
    const isDropdownContent = $(event.target).closest("#folderDropdown").length;
    // If the click is outside both the button and the dropdown content
    if (!isDropdownButton && !isDropdownContent) {
      const newFolderInput = $("#newFolderInput");
      // If new folder input is not focused or doesn't exist
      if (!newFolderInput.length || !newFolderInput.is(":focus")) {
        $("#folderList .new-folder-input").remove();
        // Uncomment this line if you want to hide the dropdown
        // $("#folderDropdown").addClass("hidden");
      } else {
        // Alert if the input field is empty
        if (!newFolderInput.val().trim()) {
          alert("Folder name cannot be empty!");
        }
      }
    }
  });
  // Function to check if folder name already exists
  function isFolderNameExists(folderName) {
    let exists = false;
    $("#folderList li").each(function () {
      if (
        $(this).find("span").text().trim().toLowerCase() ===
        folderName.toLowerCase()
      ) {
        exists = true;
        return false; // breaks the each loop
      }
    });
    return exists;
  }
});