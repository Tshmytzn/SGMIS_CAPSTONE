
<style>
.loader-line {
    width: 200px;
    height: 3px;
    position: relative;
    overflow: hidden;
    background-color: #ddd;
    margin: 5px auto; /* Reduced margin to bring closer */
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
}

.loader-line:before {
    content: "";
    position: absolute;
    left: -50%;
    height: 3px;
    width: 40%;
    background-color: coral;
    -webkit-animation: lineAnim 1s linear infinite;
    -moz-animation: lineAnim 1s linear infinite;
    animation: lineAnim 1s linear infinite;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
}

@keyframes lineAnim {
    0% {
        left: -40%;
    }
    50% {
        left: 20%;
        width: 80%;
    }
    100% {
        left: 100%;
        width: 100%;
    }
}

.center-container {
    display: flex;
    flex-direction: column; /* Stack the image and h1 vertically */
    justify-content: center; /* Center vertically */
    align-items: center; /* Center horizontally */
    height: 100%; /* Take full viewport height to center vertically */
    text-align: center; /* Align text */
   
}

</style>
<div class="center-container"  id="{{$loadID}}" style="display: none">
    <img src="/static/logoicon.png" alt="" style="width: 60px;">
    <p>loading</p>
    <div class="loader-line"></div>
</div>
