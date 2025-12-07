 <title>File Manager</title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="{HTTPS}://fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Open+Sans:300,400,600,700,800|Source+Sans+Pro:200,300,400,600,700,900">
 <link rel="stylesheet" href="{HTTPS}://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.min.css">
 <link rel="stylesheet" href="./style.css">
 <style>
     .file-manager-container {
         display: flex;
         height: 100%;
     }


     .left-panel {
         width: 250px;
         border-right: 1px solid #ddd;
         overflow-y: auto;
         padding: 10px;
     }

     .right-panel {
         flex: 1;
         display: flex;
         flex-direction: column;
         background-color: #fff;
     }

     .big-file-manager {
         flex: 1;
         overflow-y: auto;
         padding: 10px;
     }

     .folder {
         padding: 5px;
         cursor: pointer;
     }

     .folder:hover {
         background: #f0f0f0;
     }

     .children {
         margin-left: 15px;
     }

     .rename-input {
         padding: 2px 5px;
         border: 1px solid #4a90e2;
         border-radius: 3px;
         box-shadow: 0 0 5px rgba(74, 144, 226, 0.5);
         width: 80%;
         font-size: inherit;
         font-family: inherit;
     }

     .select {
         background-color: #e0f0ff;
         outline: 1px solid #4a90e2;
     }

     .rename-modal {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background-color: rgba(0, 0, 0, 0.5);
         display: flex;
         justify-content: center;
         align-items: center;
         z-index: 1000;
     }

     .rename-modal-content {
         background: white;
         width: 400px;
         max-width: 90%;
         border-radius: 5px;
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
         overflow: hidden;
     }

     .rename-modal-header {
         padding: 15px;
         background: #f5f5f5;
         border-bottom: 1px solid #ddd;
         display: flex;
         justify-content: space-between;
         align-items: center;
     }

     .rename-modal-header h3 {
         margin: 0;
         font-size: 18px;
     }

     .close-modal {
         font-size: 24px;
         cursor: pointer;
     }

     .rename-modal-body {
         padding: 20px;
     }

     .rename-input {
         width: 100%;
         padding: 8px;
         margin-top: 10px;
         border: 1px solid #ddd;
         border-radius: 3px;
         font-size: 14px;
     }

     .rename-input:focus {
         border-color: #4a90e2;
         outline: none;
     }

     .error-message {
         color: #e74c3c;
         font-size: 13px;
         margin-top: 5px;
         min-height: 18px;
     }

     .rename-modal-footer {
         padding: 15px;
         background: #f5f5f5;
         border-top: 1px solid #ddd;
         text-align: right;
     }

     .rename-modal-footer button {
         padding: 8px 15px;
         margin-left: 10px;
         border: none;
         border-radius: 3px;
         cursor: pointer;
     }

     .cancel-btn {
         background: #e0e0e0;
     }

     .confirm-btn {
         background: #4a90e2;
         color: white;
     }

     .notification {
         position: fixed;
         bottom: 20px;
         left: 50%;
         transform: translateX(-50%);
         background: #333;
         color: white;
         padding: 10px 20px;
         border-radius: 4px;
         z-index: 1000;
         animation: fadeIn 0.3s;
     }

     @keyframes fadeIn {
         from {
             opacity: 0;
         }

         to {
             opacity: 1;
         }
     }
 </style>