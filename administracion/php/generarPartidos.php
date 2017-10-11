<?php
//error_reporting(0);

class Ronda{
    public $items = array();


    public function addItem($obj, $key = null) {
        if ($key == null) {
            $this->items[] = $obj;
        }
        else {
            $this->items[$key] = $obj;
        }
    }

    public function deleteItem($key) {
        if (isset($this->items[$key])) {
            unset($this->items[$key]);
        }
    }

    public function getItem($key) {
        if (isset($this->items[$key])) {
            return $this->items[$key];
        }
    }

    public function keys() {
        return array_keys($this->items);
    }

    public function length() {
        return count($this->items);
    }

    public function getItems(){
        return $this->items;
    }

    public function keyExists($key) {
        return isset($this->items[$key]);
    }

    public function generarPosibilidades($items = null){
       if ($items == null) {
        foreach($this->items as $participante ){
            $participante->cargarPosibilidades($this->items);
        }
    }
    else {
        foreach($items as $participante ){
            $participante->cargarPosibilidades($items);
        }
    }
}
}

class Participante
{
    public $id;
    public $disp1 = false;
    public $disp2 = false;
    public $disp3 = false;
    public $disp4 = false;
    public $disp5 = false;
    public $posibilidades = array();

    public function __construct($id, $disponibilidad) {
        $this->id = $id;
        $this->procesar_disponibilidad($disponibilidad);
    }

    public function cargarPosibilidades($participantes){
        foreach ($participantes as $participante) {
            if (!($this->id == $participante->id))
            {

             $matchean = (($this->disp1 and $participante->disp1) or ($this->disp2 and $participante->disp2) or ($this->disp3 and $participante->disp3) or ($this->disp4 and $participante->disp4) or ($this->disp5 and $participante->disp5));

             if ($matchean == true) {
                $this->posibilidades[] = $participante->id;
            }
        }
    }
}

public function procesar_disponibilidad($disponibilidad){
    $this->disp1 = (bool) substr($disponibilidad, 0,1);
    $this->disp2 = (bool) substr($disponibilidad, 1,1);
    $this->disp3 = (bool) substr($disponibilidad, 2,1);
    $this->disp4 = (bool) substr($disponibilidad, 3,1);
    $this->disp5 = (bool) substr($disponibilidad, 4,1);
}

public function toString(){
    echo "id original: ". $this->id . "  Contrincantes: ";
    echo "<pre>";
    print_r($this->posibilidades);
    echo "</pre>";
}
}


function hayMatch($part1, $part2) {
    if (($part1->disp1 and $part2->disp1) or ($part1->disp2 and $part2->disp2) or ($part1->disp3 and $part2->disp3) or ($part1->disp4 and $part2->disp4) or ($part1->disp5 and $part2->disp5)){
        return true;
    } else {
        return false;
    }
}

function addPartido($Partidos, $part1, $part2, $coincide = true){
    if ($coincide) {
        if (rand(0, 1)) { 
            if ($part1->disp1 and $part2->disp1){
                $partido = array($part1->id, $part2->id, "1");
            } else if ($part1->disp2 and $part2->disp2){
                $partido = array($part1->id, $part2->id, "2");
            } else if ($part1->disp3 and $part2->disp3){
                $partido = array($part1->id, $part2->id, "3");
            } else if ($part1->disp4 and $part2->disp4){
                $partido = array($part1->id, $part2->id, "4");
            } else if ($part1->disp5 and $part2->disp5){
                $partido = array($part1->id, $part2->id, "5");
            }
        }else{
            if ($part1->disp5 and $part2->disp5){
                $partido = array($part1->id, $part2->id, "5");
            } else if ($part1->disp4 and $part2->disp4){
                $partido = array($part1->id, $part2->id, "4");
            } else if ($part1->disp3 and $part2->disp3){
                $partido = array($part1->id, $part2->id, "3");
            } else if ($part1->disp2 and $part2->disp2){
                $partido = array($part1->id, $part2->id, "2");
            } else if ($part1->disp1 and $part2->disp1){
                $partido = array($part1->id, $part2->id, "1");
            }
        }
    } else {
        $partido = array($part1->id, $part2->id, "9");
    }
$Partidos[] = $partido;
return $Partidos;

}

function eliminarYaInsertados($participantes, $part1, $part2){
    foreach ($participantes as $key => $value) {
        if (($value->id == $part1->id) or ($value->id == $part2->id)){
            unset($participantes[$key]);
        }
    }
    return array_values($participantes);
}

function deletePartido($Partidos){
    array_pop($Partidos);
    return $Partidos;
}

function generarPartidos($Partidos, $participantes, $participantes_borrados, $partido_actual,$total_participantes, $salida, $max_partidos) {
    global $salida;
    global $participantes_faltantes;
    $participantes_faltantes = $participantes;

    if ($partido_actual == ($total_participantes)/2) {
        $salida = $Partidos;
        return true;
    }

    for ($i=0; $i < (count($participantes) -1 ); $i++) { 
        //echo "Compara: ". $i ." con: ".($i+1)." <br>";
        if (hayMatch($participantes[$i], $participantes[$i+1])) { //si hay combinacion posible
            
            //inserto partido 
            $Partidos = addPartido($Partidos, $participantes[$i], $participantes[$i+1]);
            $partido_actual = $partido_actual+1;

            //a partir de la combinacion encontrada, saco los participantes y los paso a borrados
            array_push($participantes_borrados, $participantes[$i], $participantes[$i+1]);
            $participantes = eliminarYaInsertados($participantes, $participantes[$i], $participantes[$i+1]);
            
            //voy guardando la mejor combinacion de partidos
            if ($max_partidos < $partido_actual){
                $salida = $Partidos;
                $max_partidos = $max_partidos+1;
                $participantes_faltantes = $participantes;
            }

            /*
            echo "<pre>";
            print_r($Partidos);
            echo "</pre> <br>";
            echo $partido_actual;
            echo "<br> Valor de i: ";
            echo $i;
            echo "<br>"; 
            */
            
            //busco recursivamente una solucion para los participantes restantes
            if (generarPartidos($Partidos, $participantes, $participantes_borrados,$partido_actual, $total_participantes, $salida, $max_partidos)) {
                return true;
            }
            
            /*
            echo "Saliendo del genrar partidos: ";
            echo "<br> Valor de i: ";
            echo $i;
            echo "<br>"; 
            echo "<br>";
            echo "<pre>";
            print_r($participantes);
            echo "</pre> <br>";
            */

            //si no hubo solucion saco ese partido
            $Partidos = deletePartido($Partidos);

            //devuelvo los participantes a la lista de vigentes y los saco de borrados
            array_push($participantes, array_pop($participantes_borrados), array_pop($participantes_borrados));
            $participantes = array_values($participantes);

            //bajo la cantidad de partidos
            $partido_actual = $partido_actual-1;

            /*
            echo "Dsp del delete: ";
            echo "<br>";
            echo "<pre>";
            print_r($participantes);
            echo "</pre> <br>";
            */
            
        }
    }
    //$salida = $Partidos; 
    return false;
}


//conecto a la base
$connection = mysqli_connect('universys.site', 'apholos_dba', 'dbainub', 'apholos_ligaub');
if (mysqli_connect_errno()) {
    die("<script language='javascript'>
        alert('Hubo un error de conexion, intente nuevamente por favor');
        window.location.href = ../inscripcion.php';
        </script>");
}


$resultRonda = mysqli_query($connection, "SELECT ronda from Partidos order by ronda desc limit 1");
$nronda = mysqli_fetch_array($resultRonda);
$numRonda= $nronda['ronda'];
$numRonda++;

$ronda = new Ronda();
$result_disp = mysqli_query($connection,"SELECT id_inscripto, disponibilidad FROM Participantes WHERE fecha_hasta is null");

while($row = mysqli_fetch_array($result_disp))
{
    $ronda->addItem(new Participante($row['id_inscripto'], $row['disponibilidad']));
}

$participantes_borrados =array();
$Partidos = array();
$salida = array();
$participantes = $ronda->getItems();
$Partidos_final = generarPartidos($Partidos, $participantes, $participantes_borrados, 0, count($participantes), $salida, 0);


while (count($participantes_faltantes) > 0) {
    $salida = addPartido($salida, array_pop($participantes_faltantes), array_pop($participantes_faltantes), false);
};

$query = "SELECT id_fecha FROM fechas_disponibles WHERE ronda = " . $numRonda;
$result = mysqli_query($connection, $query);
$cant_fechas = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result))
{
    $fechas[]=($row['id_fecha']);
}

$query = "SELECT cantidad from consolas";
$result = mysqli_query($connection, $query);
$consolas = mysqli_fetch_array($result)['cantidad'];

$partidos_aux = $salida;
$partidos_fecha=array();
for ($i=0; $i < $cant_fechas; $i++) { 
    for ($j=0; $j < $consolas; $j++) { 
        for ($k=1; $k < 6; $k++) { //hardodeados los horarios
            $asignado = false;
            foreach ($partidos_aux as $key => $value) {
                if (($value[2] == $k) and !($asignado)){
                    $partidos_fecha[] = array($value[0],$value[1],$value[2],$fechas[$i]);
                    unset($partidos_aux[$key]);
                    $partidos_aux = array_values($partidos_aux);
                    $asignado = true;
                }                 
            }
        }
    }
};

/*
echo "<pre>";
echo "matcheados";
print_r($partidos_fecha);
echo "</pre> <br>";

echo "<pre>";
echo "auxiliar";
print_r($partidos_aux);
echo "</pre> <br>";*/


foreach ($partidos_fecha as $key => $value) {
     $query  = "INSERT INTO Partidos ( id_participante1, id_participante2, ronda,hora, fecha) 
        VALUES ('".$value[0]."','" . $value[1] . "','" . $numRonda . "','" . $value[2]."','".$value[3]."')";
        $result = mysqli_query($connection, $query);
    };

foreach ($partidos_aux as $key => $value) {
    if($value[2]=="9")
        $value[2]="5";
     $query  = "INSERT INTO Partidos ( id_participante1, id_participante2, ronda,hora,fecha, flag_error) 
        VALUES ('".$value[0]."','".$value[1] . "','" . $numRonda . "','" . $value[2]."','" . $fechas[$cant_fechas-1] . "' , 'sin fecha')";
        $result = mysqli_query($connection, $query);
};

mysqli_close($connection);

echo "<script language='javascript'>
alert('La ronda se generó correctamente');
    window.location.href = '../torneo.php';
    </script>";

?>