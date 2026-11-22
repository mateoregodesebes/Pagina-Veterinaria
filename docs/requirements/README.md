# Requerimientos y trazabilidad

## 1. Fuentes

| Documento                                                                                    | Versión                 | Para qué sirve                                                                                                          |
| -------------------------------------------------------------------------------------------- | ----------------------- | ----------------------------------------------------------------------------------------------------------------------- |
| [`UTN_EG_TP_2026_EnunciadoGral_VF.md`](UTN_EG_TP_2026_EnunciadoGral_VF.md)                   | 2026                    | Marco formal de entrega e informe. Es el más reciente y manda sobre el resto.                                           |
| [`UTN_EG_TP_Plan2023_Veterinaria_San_Anton.md`](UTN_EG_TP_Plan2023_Veterinaria_San_Anton.md) | Plan 2023               | Caso concreto de la veterinaria: roles, problemas del negocio y funcionalidades esperadas. Define el alcance funcional. |
| [`UTN_EG_TrabajoPráctico_V2022.md`](UTN_EG_TrabajoPráctico_V2022.md)                         | 2022                    | Histórico. Sirve para justificar cambios, no para definir la entrega actual.                                            |
| [`UTN_EG_Checklist.md`](UTN_EG_Checklist.md)                                                 | Plantilla de la cátedra | 86 ítems de usabilidad, accesibilidad y rapidez.                                                                        |

### Qué cambió de 2022 a 2026

El núcleo técnico no cambia: 2 ABMC, formularios, sesiones, validación cliente/servidor, paginación, mails, Bootstrap, PHP y GitHub; entrega por mail 15 días antes, dos oportunidades y checklists/validadores.

2026 agrega o endurece:

| Ítem | Cambio                                                                              |
| ---- | ----------------------------------------------------------------------------------- |
| 9    | Presupuesto con estimación por **Puntos de Función**, fundamentada.                 |
| 10   | Monetización con **cálculo de ROI** y conclusiones.                                 |
| 16   | **Declaración de uso de IA**: herramienta, versión aproximada, objetivos y detalle. |
| 17   | Enlace en el informe a la lista de verificación del repositorio de la cátedra.      |
| 18   | La conclusión se corre del índice 16 al 18.                                         |

## 2. Matriz de requisitos (enunciado 2026)

Estados: **OK** = implementado y verificable; **Parcial** = existe pero incompleto o con deuda; **Falta** = sin evidencia en el repositorio.

| Requisito                                                | Evidencia en el repositorio                                                                | Estado                                                                                       |
| -------------------------------------------------------- | ------------------------------------------------------------------------------------------ | -------------------------------------------------------------------------------------------- |
| 2 ABMC sobre base de datos                               | `src/pages/abmCliente`, `abmMascota`, `abmStaff`, `abmTurno` y `src/entity-dbs/`           | OK (hay 4)                                                                                   |
| Envío y recepción de datos por formularios               | `src/pages/contact`, `registration`, `requestAppointment`                                  | OK                                                                                           |
| Variables de sesión                                      | `$_SESSION['currentPage']`, `user_role`, `user_id` en `public/index.php` y `src/partials/` | OK                                                                                           |
| Validación cliente y servidor                            | Atributos `required`/`minlength` y validaciones en `src/entity-dbs/`                       | Parcial: servidor inconsistente, mezcla `prepare()` con `mysqli_query()` y escapado desigual |
| Paginación de resultados                                 | `LIMIT/OFFSET` en los listados de cliente, mascota, staff y turnos                         | OK                                                                                           |
| Envío de mails por el servidor                           | `src/scripts/mailer.php` (PHPMailer), verificación de cuenta y reseteo de contraseña       | OK                                                                                           |
| Bootstrap como base de HTML y CSS                        | Bootstrap 5.1.3 en `public/index.php`                                                      | Parcial: JS 4.3.1 + Popper 1.14.7 y dos versiones de jQuery conviven con el bundle 5.1.3     |
| Programación en PHP                                      | `public/index.php` como front controller y módulos en `src/`                               | OK                                                                                           |
| Código en GitHub                                         | Historial y ramas de trabajo                                                               | OK                                                                                           |
| Sitio funcionando en la Web                              | Sin URL publicada                                                                          | Falta                                                                                        |
| Informe final (carátula, índice, páginas, conclusión)    | Sin archivo de informe                                                                     | Falta                                                                                        |
| Modelo lógico y físico de datos                          | DER en `README.md` y dump actualizado en `docs/veterinarias_db.sql`                        | Parcial: falta el documento formal del informe                                               |
| Puntos de Función (ítem 9)                               | Sin estimación                                                                             | Falta                                                                                        |
| ROI (ítem 10)                                            | Sin cálculo                                                                                | Falta                                                                                        |
| Checklists de usabilidad/accesibilidad/rapidez (ítem 14) | Plantilla en `docs/requirements/UTN_EG_Checklist.md`                                       | Parcial: sin completar                                                                       |
| Validadores HTML/CSS/TAW (ítem 15)                       | Sin evidencia de resultados                                                                | Falta                                                                                        |
| Declaración de IA (ítem 16)                              | Sin declaración                                                                            | Falta                                                                                        |
| Lista de verificación del repo de la cátedra (ítem 17)   | `README.md` de la raíz existe                                                              | Parcial: falta completarla y enlazarla                                                       |

## 3. Trazabilidad del caso Plan 2023

| Funcionalidad esperada                                                        | Evidencia en el repositorio                                                                                                                             | Estado  |
| ----------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------- | ------- |
| Registro de mascotas y dueños, con mascotas asociadas al consultar un cliente | `src/pages/addPet`, `abmCliente`, `src/entity-dbs/clientes/mascotasCliente.php`                                                                         | OK      |
| Avisos de procedimientos pendientes en pantalla                               | Sin implementación                                                                                                                                      | Falta   |
| Caso fallecimiento: dejar de emitir avisos y salir de hospitalización/hotel   | Columna `mascotas.fecha_muerte` presente; sin lógica de avisos ni de baja de estadías                                                                   | Parcial |
| Consultas a domicilio con carga desde el celular                              | `src/pages/atencionDom/`                                                                                                                                | OK      |
| Registro de peluquería con especialista a cargo                               | `src/pages/requestAppointment/requestAppointmen`, `src/entity-dbs/personal/consultaPersonalPorServicio.php`, `src/entity-dbs/atenciones/altaTurnos.php` | OK      |
| Hospitalización/hotel con alta, baja e historial de estadías                  | `src/pages/inprogress/inprogress.php`                                                                                                                   | Falta   |
| Autenticación con roles: administrador, personal, cliente y anónimo           | `src/partials/roleHandler.php`, roles 1–4 y `rol_id IS NULL` para cliente                                                                               | OK      |
| Registro de auditoría: quién y cuándo modifica una ficha                      | Sin tabla ni columnas de auditoría                                                                                                                      | Falta   |

## 4. Flujo de trabajo

Se usa [`docs/git-workflow.md`](../git-workflow.md): `main` es producción, `dev` es integración y toda otra rama nace de `dev`, se integra por pull request y se elimina. Las ramas temporales siguen `<tipo>/<iniciales>-<slug>`.

## 5. Cómo mantener este índice

- Si se implementa una funcionalidad pendiente, cambiar su estado y citar el archivo que la contiene.
- Si aparece una deuda nueva, agregar en la sección 4 con el archivo afectado.
- No se borran las filas: se mantienen con su estado para que el informe pueda explicar la evolución.
