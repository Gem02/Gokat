
let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}
toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}




let profile = document.querySelector('.newheader nav .profile');

        document.querySelector('#user-btn').onclick = () =>{
        profile.classList.toggle('active');
        leftmenu.classList.remove('active');
        searchbar.classList.remove('active');
        notification.classList.remove('active');
        }

        window.onscroll = () =>{
            leftmenu.classList.remove('active');
        }


        let leftmenu = document.querySelector('main .leftside');

        document.querySelector('.fa-list-ul').onclick = () =>{
        leftmenu.classList.toggle('active');
        searchbar.classList.remove('active');
        notification.classList.remove('active');
        profile.classList.remove('active');
        }
        

        let searchbar = document.querySelector('.newheader .topleft .search-form');

        document.querySelector('.topnavsearch').onclick = () =>{
        searchbar.classList.toggle('active');
        leftmenu.classList.remove('active');
        notification.classList.remove('active');
        profile.classList.remove('active');
        }

        let notification = document.querySelector('.newheader nav .notification');
        document.querySelector('.topright .fa-bell').onclick = () =>{
        notification.classList.toggle('active');
        leftmenu.classList.remove('active');
        searchbar.classList.remove('active');
        profile.classList.remove('active');
        }


        let menuoptions = document.querySelector('main .headermoreoptions');
        let rotateimg = document.querySelector('main .menuseemore img');
        document.querySelector('main .menuseemore').onclick = () =>{
            menuoptions.classList.toggle('active');
            rotateimg.classList.toggle('active');
        } 


        const postoptions = document.querySelector('.centered .feedpost .mainpost .friend_post_top .postoptions ul');
        document.querySelector('.centered .feedpost .mainpost .friend_post_top .menu').onclick = () =>{
            alert('yeat');
            postoptions.classList.toggle('active');
        }
       



        const navList = document.querySelectorAll('.navleftside .leftside a');
        navList.forEach(element => {
            element.onclick = () =>{
                element.classList.add('active');
            }
        });

      

        document.querySelector('.logoutbtn').onclick = () => {
            swal({
                  title: "Are you sure?",
                  text: "You will be logged out from Gokat Services!",
                  icon: "warning",
                  buttons: true,
                  })
        }