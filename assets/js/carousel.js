//Carousel
if (document.getElementById('container-carousel')) {
    const carousel = [
        {
            picture: "https://cdn.pixabay.com/photo/2016/07/07/12/48/reload-crew-1502408_960_720.jpg",
            alt: "Elèves",
            title: "Elèves"
        },
        {
            picture: "https://images.pexels.com/photos/12312/pexels-photo-12312.jpeg",
            alt: "Salle de danse",
            title: "Salle de danse"
        },
        {
            picture: "https://images.pexels.com/photos/6926598/pexels-photo-6926598.jpeg",
            alt: "Salle de danse",
            title: "Salle de danse"
        },
        {
            picture: "https://cdn.pixabay.com/photo/2020/10/10/21/54/performers-5644247_960_720.jpg",
            alt: "Spectacle de fin d'année : Lumière",
            title: "Spectacle de fin d'année"
        },
        {
            picture: "https://images.pexels.com/photos/3753820/pexels-photo-3753820.jpeg",
            alt: "Spectacle de fin d'année : Groupe de danseuses",
            title: "Spectacle de fin d'année"
        },
        {
            picture: "https://images.pexels.com/photos/209948/pexels-photo-209948.jpeg",
            alt: "Spectacle de fin d'année : Trois danseuses",
            title: "Spectacle de fin d'année"
        },
        {
            picture: "https://cdn.pixabay.com/photo/2015/01/14/20/31/indian-dance-599611_960_720.jpg",
            alt: "Spectacle de fin d'année : Danse bollywood",
            title: "Spectacle de fin d'année"
        },
        {
            picture: "https://cdn.pixabay.com/photo/2019/12/29/18/40/dance-4727835_960_720.jpg",
            alt: "Spectacle de fin d'année : Danse Jazz",
            title: "Spectacle de fin d'année"
        },
        {
            picture: "https://cdn.pixabay.com/photo/2020/05/15/15/22/dance-5173943_960_720.jpg",
            alt: "Spectacle de fin d'année : Danse africaine",
            title: "Spectacle de fin d'année"
        },
        {
            picture: "https://cdn.pixabay.com/photo/2020/06/20/16/32/dance-5321562_960_720.jpg",
            alt: "Spectacle de fin d'année : Danse Modern Jazz",
            title: "Spectacle de fin d'année"
        },
    ];

    const divCarousel = document.getElementById('container-carousel');
    const buttonR = document.getElementById('rightButton');
    const buttonL = document.getElementById('leftButton');
    const pictureCarousel = document.querySelector('.photo-carousel');
    const carouselTitle = document.querySelector('.carousel-title');
    let i = 0;

    buttonR.addEventListener('click', function(){
        if (i == carousel.length - 1) {
            i = 0;
            pictureCarousel.setAttribute('src', carousel[i].picture);
            pictureCarousel.setAttribute('alt', carousel[i].alt);
            carouselTitle.innerHTML = `${carousel[i].title}`;
        } else {
            i++;
            pictureCarousel.setAttribute('src', carousel[i].picture);
            pictureCarousel.setAttribute('alt', carousel[i].alt);
            carouselTitle.innerHTML = `${carousel[i].title}`;
        } 
    });

    buttonL.addEventListener('click', function(){
        if (i == 0){
            i = carousel.length - 1;
            pictureCarousel.setAttribute('src', carousel[i].picture);
            pictureCarousel.setAttribute('alt', carousel[i].alt);
            carouselTitle.innerHTML = `${carousel[i].title}`;
        } else {
            i--;
            pictureCarousel.setAttribute('src', carousel[i].picture);
            pictureCarousel.setAttribute('alt', carousel[i].alt);
            carouselTitle.innerHTML = `${carousel[i].title}`;
        }      
    });
    
}
