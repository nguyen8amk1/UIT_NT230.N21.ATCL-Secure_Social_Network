<div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-11/12 lg:w-full md:w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg mb-12">

        <form method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="title">Title</label>
                <input id="title" class="block mt-1 mb-2 w-full" type="text" name="title" />
            </div>

            <div>
                <label for="location">Location</label>
                <input id="location" class="block mt-1 w-full" type="text" name="location" />
            </div>

            <div class="mt-4">
                <label for="body">Description</label>
                <textarea rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow" name="body"></textarea>
            </div>

            <div class="mt-4" id="filePreviewContainer" style="display: none;">
                <label>Preview :</label>
                <img id="imagePreview" class="p-3 h-32" src="" alt="Image Preview" style="display: none;">
                <video id="videoPreview" controls crossorigin playsinline oncontextmenu="return false;" controlsList="nodownload" class="rounded-lg filter" style="display: none;">
                    <source id="videoSource" src="" type="">
                    <a href="" id="videoDownload" download>Download</a>
                </video>
                <p id="invalidFile" class="text-red-700 text-sm my-3" style="display: none;">Invalid File selected. You can only upload JPG, JPEG, PNG, MP4 file types.</p>
            </div>

            <div class="mt-4">
                <label for="media">Media</label>
                <input id="media" type="file" name="file" onchange="handleFileChange(event)">
            </div>

            <div id="uploadingMessage" class="my-3" style="display: none;">Uploading...</div>

            <div id="progressBarContainer" class="my-2" style="display: none;">
                <progress id="progressBar" max="100" value="0"></progress>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="ml-4">
                    Create Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    /* const imageFormats = ['jpg', 'jpeg', 'png']; */
    /* const videoFormats = ['mp4']; */
    /**/
    /* function handleFileChange(event) { */
    /*     const file = event.target.files[0]; */
    /*     const filePreviewContainer = document.getElementById('filePreviewContainer'); */
    /*     const imagePreview = document.getElementById('imagePreview'); */
    /*     const videoPreview = document.getElementById('videoPreview'); */
    /*     const videoSource = document.getElementById('videoSource'); */
    /*     const videoDownload = document.getElementById('videoDownload'); */
    /*     const invalidFile = document.getElementById('invalidFile'); */
    /**/
    /*     if (file) { */
    /*         const fileExtension = file.name.split('.').pop().toLowerCase(); */
    /*         const fileUrl = URL.createObjectURL(file); */
    /**/
    /*         filePreviewContainer.style.display = 'block'; */
    /*         imagePreview.style.display = 'none'; */
    /*         videoPreview.style.display = 'none'; */
    /*         invalidFile.style.display = 'none'; */
    /**/
    /*         if (imageFormats.includes(fileExtension)) { */
    /*             imagePreview.src = fileUrl; */
    /*             imagePreview.style.display = 'block'; */
    /*         } else if (videoFormats.includes(fileExtension)) { */
    /*             videoSource.src = fileUrl; */
    /*             videoSource.type = `video/${fileExtension}`; */
    /*             videoPreview.load(); */
    /*             videoPreview.style.display = 'block'; */
    /*             videoDownload.href = fileUrl; */
    /*         } else { */
    /*             invalidFile.style.display = 'block'; */
    /*         } */
    /*     } */
    /* } */
</script>

