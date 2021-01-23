const updateStatus = ()=>{
    $.ajax('../update.php', {
        type: "POST",
        success: (data, status)=>{

        }
    })
}

const getUsers = ()=>{
    $.ajax('../getUsers.php', {
        type: "POST",
        dataType: "JSON",
        success: (data, status)=>{
            for(let i = 0; i < data.length; i++){
                const id = data[i].id;
                const status = data[i].status;
                const statusTag = document.querySelector(`.${id} .status`);
                const sessionTag = document.querySelector(`.${id} .sessions`);
                if (status == 'online'){
                    statusTag.classList.add('online');
                    statusTag.classList.remove('offline');
                    statusTag.textContent = 'Online';
                }else{
                    statusTag.classList.add('offline');
                    statusTag.classList.remove('online');
                    statusTag.textContent = 'Offline';
                }
                sessionTag.textContent = data[i].sessions;
            }
        }
    })
}

setInterval(getUsers, 1100);
setInterval(updateStatus, 1000);