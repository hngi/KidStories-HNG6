@extends('layouts.app')
@section('custom_css')
    <link href="{{ asset('css/singlestory.css') }}" rel="stylesheet" type="text/css" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" 
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" 
        crossorigin="anonymous">
@endsection
@section('content')
<div class="banner">
    <img class="banner-image" src="https://res.cloudinary.com/solape/image/upload/v1556431411/Screen_Shot_2019-04-28_at_7.03.06_AM.png" alt="banner">
 </div>

 <div id="main">

 </div>

 <h1>The Legend Of The Dragon That Fell From The Sky</h1>

 <div class="sections">
    <h2>What is Lorem Ipsum?</h2>
    <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
 </div>

 <div class=image>
    <img src="https://res.cloudinary.com/solape/image/upload/v1556481719/dragon.svg">
    <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. </p>
    <p> The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. </p>

 </div>
 <div class="tags">
    <div> <button type="submit" id="submit"> dragon </button> <button type="submit" id="submit"> history </button> <button type="submit" id="submit"> dragon </button> <button type="submit" id="submit"> history </button></div>
    <div> <i class="fa fa-thumbs-down"> <span> 445 </span></i>
          <i class="fa fa-thumbs-up"> <span> 445 </span></i>
    </div>

 </div>





 <hr>
 <h2 class="h20"> Stories You Might Like </h2>
 <div id="stories">

     <div class="stories-p">
         <div> <img src="https://res.cloudinary.com/solape/image/upload/v1556534093/Myth.svg" class="img"></div>
             <div>
                 <h2> The Legend of the Dragon that Fell From the Sky</h2>
                    <p>  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. <br><span> <a href="#">Read More... </a> </span>  </p>
             
             </div>
         </div>
     </div>
 </div>
     <div id="stories">

     <div class="stories-p">
         <div> <img src="https://res.cloudinary.com/solape/image/upload/v1556534093/Myth.svg" class="img"></div>
             <div>
                 <h2> The Legend of the Dragon that Fell From the Sky</h2>
                    <p>  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. <br> <span> <a href="#">Read More... </a> </span> </p>
         
             </div>
         </div>
     </div>
 </div>
 <div id="stories">

         <div class="stories-p">
             <div> <img src="https://res.cloudinary.com/solape/image/upload/v1556534093/Myth.svg" class="img"></div>
                 <div>
                     <h2> The Legend of the Dragon that Fell From the Sky</h2>
                        <p>  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham. <br><span> <a href="#">Read More... </a> </span>  </p>
                 
                 </div>
             </div>
         </div>
     </div>

@endsection
