# 🎯 Pote Quiniela

Este plugin para WordPress calcula automáticamente el **pote acumulado** de una quiniela deportiva en función de la cantidad de suscriptores registrados, usando el plugin **Ultimate Member**.

## 🔧 Características

- Establece un **monto base** desde donde parte el acumulado.
- Define el **precio por suscripción**.
- Aplica una **comisión (%)** que se descuenta del valor de cada suscripción.
- El pote se **actualiza automáticamente** cuando se registra un nuevo usuario con el rol `subscriber`.
- Incluye un shortcode `[pote_acumulado]` para mostrar el monto acumulado en cualquier parte del sitio.

## 🧮 Cálculo del pote

pote = monto_base + (cantidad_usuarios * (precio_suscripción - comisión))


La comisión se calcula como un porcentaje del precio de suscripción.

---

## 🚀 Instalación

1. Descarga el plugin desde GitHub o súbelo directamente desde el panel de WordPress.
2. Actívalo desde el panel de Plugins.
3. Ve a **Ajustes > Configuración Pote** para definir:
   - Monto base
   - Precio por suscripción
   - Comisión (%)
4. Usa el shortcode `[pote_acumulado]` donde quieras mostrar el pote (entradas, páginas, widgets, etc.)

---

## 📦 Requisitos

- WordPress 5.0 o superior
- Plugin [Ultimate Member](https://wordpress.org/plugins/ultimate-member/) activo
- PHP 7.4 o superior

---

## 🧑‍💻 Autor

Desarrollado por [Ángel Ferrer](https://angelferrer.site) 🧠  
Contacto: contacto@hogarclick.cl

---

## 📝 Licencia

Este plugin está disponible bajo la licencia MIT.
