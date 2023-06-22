<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
          .content-auto {
            content-visibility: auto;
          }
        }
      </style>
</head>

<body>

    <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="" type="button">
        <img class="w-10 h-10 mr-2 rounded-full" src="./Uploads/shahin_shahin@gmail.com.jpg" alt="user photo">
    </button>

    <div id="popup-modal" tabindex="-1" class="fixed hidden top-0 left-0 right-0 z-50 ">
        <img class="w-20 h-20 rounded-full" src="./Uploads/shahin_shahin@gmail.com.jpg" alt="user photo">
    </div>
</body>

</html>