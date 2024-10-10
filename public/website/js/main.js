
// Onhover Div Change
// $(document).ready(function () {

//   //save big images
//   var $bigItem = $('.image-big-list-item');
//   //save small images
//   var $smallItem = $('.image-small-list-item');
//   //click and moseenter function on small image
//   //you could delete one eventlistener
//   $smallItem.on('click mouseenter', function () {
//     //remove active class from all items
//     $bigItem.removeClass('active');
//     $smallItem.removeClass('active');
//     //add active class to item as small item's index
//     $bigItem.eq($(this).index()).addClass('active');
//     $smallItem.eq($(this).index()).addClass('active');
//   });

// });

const accordion = document.querySelectorAll('.accordion h3');
let mainParent;
let height;
let answer;
accordion.forEach(item => {
  item.addEventListener('click', () => {
    height = item.parentElement.nextElementSibling.firstElementChild.offsetHeight;
    answer = item.parentElement.nextElementSibling;
    mainParent = item.parentElement.parentElement;
    if (mainParent.classList.contains('active')) {
      mainParent.classList.remove('active');
      answer.style.height = `0px`;
    } else {
      mainParent.classList.add('active');
      answer.style.height = `${height}px`;
    }
  });
});