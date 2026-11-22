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

- Teoría: Daniela Díaz
- Práctica: Julián Butti

### Tecnologias utilizadas

El sitio web fue realizado usando:

- HTML
- CSS
- PHP

## Diagrama Entidad-Relación (DER/ERD)

El modelo físico actual está en [`docs/veterinarias_db.sql`](docs/veterinarias_db.sql). Clientes y personal comparten la tabla `personas`: un cliente se identifica con `rol_id IS NULL` y el staff con un `rol_id` de 1 a 4.

```mermaid
erDiagram
    Persona {
        int id PK
        string nombre
        string apellido
        string email
        string clave "hash bcrypt"
        string ciudad
        string direccion
        string telefono
        int rol_id FK "NULL = cliente"
        tinyint is_verified "DEFAULT 0"
        string verification_token_hash
        datetime verification_expires_at
        string reset_token_hash
        datetime reset_token_expires_at
    }
    Mascota {
        int id PK
        int cliente_id FK "histórico: Persona.id"
        string nombre
        string foto
        string raza
        string color
        date fecha_de_nac
        date fecha_muerte "NULL = viva"
    }
    Atencion {
        int id PK
        int mascota_id FK
        int servicio_id FK
        int personal_id FK "histórico: Persona.id"
        datetime fecha_hora
        string titulo
        string descripcion
    }
    Servicio {
        int id PK
        string nombre
        string tipo
        float precio
    }
    Rol {
        int id PK
        string nombre
    }

    Rol ||--o{ Persona : clasifica
    Persona ||--o{ Mascota : tiene
    Mascota ||--o{ Atencion : recibe
    Servicio ||--o{ Atencion : se_aplica_en
    Persona ||--o{ Atencion : registra
```
