<?php
/*
Plugin Name: Pote Quiniela
Description: Calcula el pote acumulado según suscripciones usando Ultimate Member.
Author: Ángel Ferrer
Version: 1.0
*/

if (!defined('ABSPATH')) exit;

// Registrar las opciones
function pq_registrar_opciones() {
    add_menu_page('Configuración Pote', 'Configuración Pote', 'manage_options', 'configuracion_pote', 'pq_formulario_configuracion');
}
add_action('admin_menu', 'pq_registrar_opciones');

// Formulario para configurar los valores
function pq_formulario_configuracion() {
    if (isset($_POST['pq_guardar'])) {
        update_option('pq_monto_base', floatval($_POST['pq_monto_base']));
        update_option('pq_precio_suscripcion', floatval($_POST['pq_precio_suscripcion']));
        update_option('pq_comision', floatval($_POST['pq_comision']));
        echo '<div class="updated"><p>Configuración guardada.</p></div>';
    }

    $monto_base = get_option('pq_monto_base', 250000);
    $precio = get_option('pq_precio_suscripcion', 5000);
    $comision = get_option('pq_comision', 15);
    ?>
    <div class="wrap">
        <h2>Configuración del Pote Acumulado</h2>
        <form method="post">
            <label>Monto base ($):</label><br>
            <input type="number" step="0.01" name="pq_monto_base" value="<?php echo esc_attr($monto_base); ?>"><br><br>

            <label>Precio por suscripción ($):</label><br>
            <input type="number" step="0.01" name="pq_precio_suscripcion" value="<?php echo esc_attr($precio); ?>"><br><br>

            <label>Comisión (%):</label><br>
            <input type="number" step="0.01" name="pq_comision" value="<?php echo esc_attr($comision); ?>"><br><br>

            <input type="submit" name="pq_guardar" class="button button-primary" value="Guardar configuración">
        </form>
    </div>
    <?php
}

// Shortcode [pote_acumulado] con cálculo dinámico
function pq_shortcode_pote() {
    $monto_base = get_option('pq_monto_base', 250000);
    $precio = get_option('pq_precio_suscripcion', 5000);
    $comision = get_option('pq_comision', 15);

    // Obtener cantidad de suscriptores (rol subscriber)
    $args = array(
        'role'    => 'subscriber',
        'orderby' => 'ID',
        'order'   => 'ASC',
        'fields'  => 'ID',
        'count_total' => true,
    );
    $usuarios = new WP_User_Query($args);
    $cantidad = $usuarios->get_total();

    // Calcular comisión monetaria
    $comision_valor = $precio * ($comision / 100);
    $aporte_por_usuario = $precio - $comision_valor;

    $pote_total = $monto_base + ($cantidad * $aporte_por_usuario);

    return "<strong>acumulado en el pote:</strong> $" . number_format($pote_total, 0, ',', '.');
}
add_shortcode('pote_acumulado', 'pq_shortcode_pote');
