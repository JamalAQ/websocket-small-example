// let deleteUser = document.querySelector("#deleteUser");

// deleteUser.onclick = function() {
//     let theNameWhichWillBeDeleted = document.querySelector("#theNameWhichWillBeDeleted").value;
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", `classes/functions.php?deleteuser=${theNameWhichWillBeDeleted}`, true); 
//     xhr.send();

    // ########################### by post ###################################

    // var xhr = new XMLHttpRequest();

    // xhr.open("POST", "classes/functions.php", true);
  
    // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    // xhr.send(`deleteuser=${theNameWhichWillBeDeleted}`);
// }


// let updateUser = document.querySelector("#updateUser");

// updateUser.onclick = function() {
//     let oldusername = document.querySelector("#oldusername").value;
//     let newusername = document.querySelector("#newusername").value;
//     let newemail = document.querySelector("#newemail").value;
//     let newpassword = document.querySelector("#newpassword").value;
    
//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", `classes/functions.php?oldusername=${oldusername}&newusername=${newusername}&newemail=${newemail}&newpassword=${newpassword}`, true); 
//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             console.log(xhr.responseText);
//         }
//     };
//     xhr.send();
// }


let socket = new WebSocket("ws://localhost:8083");

        socket.onopen = function(event) {
            console.log("Connected to the WebSocket server.");
        };

        // in case of one demande of information form the backend
        // socket.onmessage = function(event) {
        //     let messages = JSON.parse(event.data);
        //     displayUsers(messages);
        // };

        // in our case here we use more than one ask for information from the backend
        socket.onmessage = function(event) {
            let data  = JSON.parse(event.data);
            // displayUsers(data.users);
            displayFirstUser(data.firstUser);
            displayUsers2(data.users)
        };

        socket.onclose = function(event) {
            console.log("Disconnected from the WebSocket server.");
        };

        socket.onerror = function(error) {
            console.log("WebSocket error: " + error);
        };

        function displayFirstUser(messages) {
            let messagesDiv = document.getElementById('firstuserhere');
            messagesDiv.innerHTML = ''; // مسح الرسائل القديمة
            
                let div = document.createElement('div');
                div.innerHTML = `${messages}<br>`;
                messagesDiv.appendChild(div);
            

            messagesDiv.scrollTop = messagesDiv.scrollHeight; // تمرير إلى الأسفل
        }

        
        function displayUsers(messages) {
            let messagesDiv = document.getElementById('usersNames');
            messagesDiv.innerHTML = ''; // مسح الرسائل القديمة
            console.log(messages);

            messages.forEach(msg => {
                let div = document.createElement('div');
                div.innerHTML = `${msg.username}<br>`;
                messagesDiv.appendChild(div);
            });

            messagesDiv.scrollTop = messagesDiv.scrollHeight; // تمرير إلى الأسفل
        }

        function displayUsers2(infos) {
            let informationTable = document.getElementById(`informationTable`);
            informationTable.innerHTML=`
            <div class="row justify-content-center" id="informationTable">
    <div class="col-4 text-center">Username</div>
    <div class="col-4 text-center">Email</div>
    <div class="col-4 text-center">Password</div>
    </div>
            `
            infos.forEach(info =>{
                informationTable.innerHTML+=`
                <div class="col-4 text-center">${info.username}</div>
                <div class="col-4 text-center">${info.email}</div>
                <div class="col-4 text-center">${info.password}</div>
                `
            })
        }

        function addUser() {
            let addUserName = document.getElementById('addUserName');
            let addEmail = document.getElementById('addEmail');
            let addPassword = document.getElementById('addPassword');

            let username = addUserName.value;
            let email = addEmail.value;
            let password = addPassword.value;

            let data = {type : "addUser" , username : username , email : email , password : password }
            socket.send(JSON.stringify(data));
            addUserName.value = '';
            addEmail.value = '';
            addPassword.value = '';

        }


        function deleteUser() {
            let input = document.getElementById('theNameWhichWillBeDeleted');
            let message = input.value;
            let data = {type : "deleteUser" , content : message}
            socket.send(JSON.stringify(data));
            input.value = '';
        }


        function ubdateUser() {
            let oldusername = document.getElementById('oldusername');
            let newusername = document.getElementById('newusername');
            let newemail = document.getElementById('newemail');
            let newpassword = document.getElementById('newpassword');


            let oldusernameValue = oldusername.value;
            let username = newusername.value;
            let email = newemail.value;
            let password = newpassword.value;

            let data = {type : "ubdateUser" , oldusername : oldusernameValue , newusername : username , newemail : email , newpassword : password }
            socket.send(JSON.stringify(data));
            oldusername.value = '';
            newusername.value = '';
            newemail.value = '';
            newpassword.value = '';

        }