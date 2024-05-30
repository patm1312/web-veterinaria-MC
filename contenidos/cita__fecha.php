<?php
?>
<section class="">
    <div class="h1__box">
            <h1 class="poster__description--h1 poster__description--h1--canva h1__cita"><span class="poster__description--span poster__description--h1--canva h1__cita">A</span><span class="poster__description--span2 poster__description--h1--canva h1__cita">genda</span><br>una cita con nosotros</h1>
    </div>
    <form  class="form dateSubmit" action="contenidos/acciones/datosCitaF.php" method="post" id="validatorDate">
        <input type="hidden" id="fecha_ajax">
        <div class="form__header form__header--cita">
            <!-- <a href="">
                <img class="left" src="assets/images/rght.png" alt="flecha">
            </a> -->
            <img class="form__header--img" src="assets/images/logolarge.png" alt="">
            <div>
                
            </div>
        </div>
        <div class="form__body">    
                <h2 class="form__h2 poster__description--h1" >Agenda en pocos pasos</h2>
                <!-- <span class="form__span" >¿Tienes una cuenta? <a class="form--text form--text1" href="index.php?seccion=login">Iniciar Sesion</a></span> -->
                <p class="form__p poster__description--h1">Por favor elige la fecha para tu cita con el medico veterinario</a>.
                </p> 
                <input name="inputFormatoDate" type="hidden" id="inputFormatoDate" value="">
                <input list="listaFecha" type="date"  min="2024-02-20 14:00"  id="dateFC" name="fechaC" class="input">
                <div class="hora__box" >
                    <div class="hora_box-hora">
                        <p class="poster__description--h1" >Hora:</p>
                        <select id="hora" class="border" name="hora">
                            <optgroup label="AM">
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </optgroup>
                            <optgroup label="PM">
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="hora_box-hora hora_box-h">
                        <p class="border poster__description--h1">:</p>
                    </div>
                    <div class="hora_box-hora">
                        <p class="poster__description--h1">Minutos:</p>
                        <select id="min" class="border" name="min">
                            <option>00</option>
                            <option>30</option>
                        </select>
                    </div>
                    <div class="hora_box-hora hora_box-h poster__description--h1">
                        <p class="border poster__description--h1" id="dia__date">AM</p>
                    </div>
                    
                </div>
                <div id="ulBox__date" class="ul__date">
                    <ul  id="ul__date"></ul>
                </div>
                
                <input id="sendDate" class="bottom__form bottom bottom--orange bottom__serv" type="submit" value="Continuar">
 
                <a class="" href="">
                    <div class="form__boxayuda">
                        <img class="form__boxayuda--img" src="assets/images/whatsapp.png" alt="whatsapp">
                        <p class="form__boxayuda--p">¿Necesitas <br> ayuda?</p>
                    </div>
                </a>          
        </div>
    </form>
</section>
