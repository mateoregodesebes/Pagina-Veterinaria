# Página de la veterinaria

### Integrantes

| Legajo |      Apellido y Nombre      |
| :----: | :-------------------------: |
| 51657  | Quagliardi, Martín Nicolás. |
| 51079  |  Regodesebes, Mateo Ariel   |
| 48128  |       Socolsky, José        |
| 51415  |   Alesandroni, Valentino    |

## Introducción

Este repositorio contiene el trabajo relacionado con la página web de la veterinaria del Grupo 10, desarrollado para la materia electiva "Entornos Gráficos" de la Universidad Tecnológica Nacional, Facultad Regional Rosario (UTN-FRRO).

Los profesores responsables de esta materia son:

-   Teoría: Daniela Díaz
-   Práctica: Julián Butti

### Tecnologias utilizadas

El sitio web fue realizado usando:

-   HTML
-   CSS
-   PHP

## Diagrama Entidad-Relación (DER/ERD)

```mermaid
erDiagram
    Cliente {
        int id
        string nombre
        string apellido
        string email
        string ciudad
        string direccion
        string telefono
    }
    Mascota {
        int id
        int cliente_id
        string nombre
        blob foto
        string raza
        string color
        date fecha_de_nac
        date fecha_muerte(NULL)
    }
    Atencion {
      int id
      int mascota_id
      int servicio_id
      int personal_id
      datetime fecha_hora
      string titulo
      string descripcion
    }
    Servicio {
        int id
        string nombre
        string tipo
        int precio
    }
    Personal {
      int id
      int rol_id
      string email
      string clave
    }
    Rol {
      int id
      string nombre
    }

    Mascota ||--o{ Atencion : recibe
    Cliente ||--|{ Mascota : tiene
    Atencion }o--|| Servicio: con
    Personal }o--|| Rol: tiene
    Atencion }o--|| Personal: realiza
```
