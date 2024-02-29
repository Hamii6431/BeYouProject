let lastScrollTop = 0; // Kezdő görgetési pozíció
    
        window.addEventListener("scroll", function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    
            if (currentScroll > lastScrollTop) {
                // Lefelé görgetéskor
                document.querySelector(".container-navbar").style.top = "-100px"; // Elrejtjük a navbar-t
            } else {
                // Felfelé görgetéskor
                document.querySelector(".container-navbar").style.top = "0"; // Megjelenítjük a navbar-t
            }
            lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Frissítjük az utolsó görgetési pozíciót
        }, false);