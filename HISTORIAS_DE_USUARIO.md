# HISTORIAS DE USUARIO
## Sistema de Gestión de Reciclaje Educativo - SediEcoTech

**Versión:** 1.0  
**Fecha:** 2025  
**Proyecto:** Sistema de Gestión de Reciclaje Educativo

---

## ÍNDICE

1. [Autenticación y Gestión de Usuarios](#1-autenticación-y-gestión-de-usuarios)
2. [Gestión de Proyectos](#2-gestión-de-proyectos)
3. [Gestión de Instituciones Educativas](#3-gestión-de-instituciones-educativas)
4. [Gestión de Participantes](#4-gestión-de-participantes)
5. [Gestión de Materiales Reciclables](#5-gestión-de-materiales-reciclables)
6. [Registro de Recolecciones](#6-registro-de-recolecciones)
7. [Sistema de Premios](#7-sistema-de-premios)
8. [Sistema de Canjes](#8-sistema-de-canjes)
9. [Ranking y Competencias](#9-ranking-y-competencias)
10. [Gestión de Anuncios](#10-gestión-de-anuncios)
11. [Dashboards y Reportes](#11-dashboards-y-reportes)
12. [Configuración del Sistema](#12-configuración-del-sistema)

---

## 1. AUTENTICACIÓN Y GESTIÓN DE USUARIOS

### HU-001: Inicio de Sesión de Administrador

**Como** administrador del sistema  
**Quiero** iniciar sesión con mis credenciales  
**Para** acceder al panel de administración y gestionar el sistema

**Criterios de Aceptación:**
- El sistema debe mostrar un formulario de inicio de sesión
- Debe validar credenciales (email y contraseña)
- Debe redirigir al dashboard administrativo tras un inicio de sesión exitoso
- Debe mostrar mensajes de error claros para credenciales inválidas
- Debe mantener la sesión activa durante el uso del sistema

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-002: Registro de Nuevo Administrador

**Como** administrador principal  
**Quiero** registrar nuevos usuarios administradores  
**Para** delegar responsabilidades de gestión del sistema

**Criterios de Aceptación:**
- Debe existir un formulario de registro de administradores
- Debe validar que el email sea único
- Debe requerir contraseña segura
- Debe asociar el usuario con una persona existente
- Debe permitir asignar rol de administrador
- Debe enviar confirmación de registro exitoso

**Prioridad:** Media  
**Estimación:** 3 puntos

---

### HU-003: Inicio de Sesión de Participante

**Como** participante (estudiante)  
**Quiero** iniciar sesión con mi DNI y contraseña  
**Para** acceder a mi panel personal y ver mi progreso

**Criterios de Aceptación:**
- El sistema debe permitir inicio de sesión con DNI
- Debe validar que el participante esté activo
- Debe redirigir al dashboard del participante tras login exitoso
- Debe mostrar mensajes de error apropiados
- Debe mantener sesión durante la navegación

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-004: Gestión de Perfil de Administrador

**Como** administrador  
**Quiero** actualizar mi información de perfil  
**Para** mantener mis datos actualizados en el sistema

**Criterios de Aceptación:**
- Debe permitir editar nombre, email y foto de perfil
- Debe validar que el email sea único si se modifica
- Debe permitir cambiar contraseña con confirmación
- Debe mostrar mensajes de éxito/error
- Debe actualizar la información en tiempo real

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-005: Gestión de Perfil de Participante

**Como** participante  
**Quiero** ver y actualizar mi información personal  
**Para** mantener mis datos correctos en el sistema

**Criterios de Aceptación:**
- Debe mostrar información personal del participante
- Debe permitir actualizar datos editables
- Debe permitir cambiar contraseña
- Debe mostrar información de institución y proyecto asociado
- Debe validar datos antes de guardar

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-006: Gestión de Usuarios Administradores

**Como** administrador  
**Quiero** gestionar (crear, editar, eliminar) usuarios administradores  
**Para** controlar el acceso al sistema administrativo

**Criterios de Aceptación:**
- Debe mostrar lista de usuarios administradores
- Debe permitir crear nuevos usuarios
- Debe permitir editar usuarios existentes
- Debe permitir eliminar usuarios (con confirmación)
- Debe mostrar estado del usuario (Activo/Inactivo)
- Debe permitir cambiar estado del usuario

**Prioridad:** Media  
**Estimación:** 3 puntos

---

## 2. GESTIÓN DE PROYECTOS

### HU-007: Crear Proyecto

**Como** administrador  
**Quiero** crear nuevos proyectos ecológicos  
**Para** organizar las actividades de reciclaje por iniciativa

**Criterios de Aceptación:**
- Debe mostrar formulario con campos: nombre, logo, estado
- Debe permitir subir imagen de logo del proyecto
- Debe validar que el nombre sea único
- Debe permitir establecer estado inicial (Activo/Inactivo)
- Debe guardar el proyecto y mostrar confirmación
- Debe redirigir a la lista de proyectos tras crear

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-008: Listar Proyectos

**Como** administrador  
**Quiero** ver todos los proyectos registrados  
**Para** tener una visión general y gestionarlos

**Criterios de Aceptación:**
- Debe mostrar tabla con todos los proyectos
- Debe mostrar: nombre, logo, estado, fecha de creación
- Debe permitir filtrar por estado
- Debe permitir buscar por nombre
- Debe incluir acciones: ver, editar, eliminar
- Debe mostrar paginación si hay muchos proyectos

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-009: Editar Proyecto

**Como** administrador  
**Quiero** modificar información de proyectos existentes  
**Para** actualizar datos cuando sea necesario

**Criterios de Aceptación:**
- Debe mostrar formulario prellenado con datos actuales
- Debe permitir modificar nombre, logo y estado
- Debe validar cambios antes de guardar
- Debe actualizar el proyecto en la base de datos
- Debe mostrar mensaje de éxito
- Debe mantener relaciones con instituciones y materiales

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-010: Eliminar Proyecto

**Como** administrador  
**Quiero** eliminar proyectos que ya no se utilizan  
**Para** mantener el sistema organizado

**Criterios de Aceptación:**
- Debe solicitar confirmación antes de eliminar
- Debe validar que no tenga recolecciones asociadas
- Debe mostrar advertencia si tiene datos relacionados
- Debe eliminar el proyecto y sus relaciones
- Debe mostrar mensaje de confirmación

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-011: Activar/Desactivar Proyecto

**Como** administrador  
**Quiero** activar o desactivar proyectos  
**Para** controlar qué proyectos están disponibles para nuevas recolecciones

**Criterios de Aceptación:**
- Debe permitir cambiar estado con un toggle
- Debe actualizar el estado inmediatamente
- Debe mostrar confirmación visual del cambio
- Debe afectar la disponibilidad en formularios de recolección
- Debe mantener historial de recolecciones anteriores

**Prioridad:** Alta  
**Estimación:** 1 punto

---

### HU-012: Asociar Instituciones a Proyecto

**Como** administrador  
**Quiero** asociar instituciones educativas a un proyecto  
**Para** definir qué instituciones participan en cada iniciativa

**Criterios de Aceptación:**
- Debe mostrar lista de instituciones disponibles
- Debe permitir seleccionar múltiples instituciones
- Debe establecer fechas de inicio y fin de participación
- Debe permitir crear institución nueva desde el formulario
- Debe validar que no haya duplicados
- Debe mostrar instituciones ya asociadas

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-013: Gestionar Participantes de Institución en Proyecto

**Como** administrador  
**Quiero** ver y gestionar participantes de una institución en un proyecto específico  
**Para** administrar la lista de estudiantes participantes

**Criterios de Aceptación:**
- Debe mostrar lista de participantes de la institución-proyecto
- Debe permitir agregar nuevos participantes
- Debe permitir eliminar participantes
- Debe mostrar información: nombre, DNI, nivel académico, puntaje
- Debe validar que el participante no esté duplicado

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

## 3. GESTIÓN DE INSTITUCIONES EDUCATIVAS

### HU-014: Crear Institución Educativa

**Como** administrador  
**Quiero** registrar nuevas instituciones educativas  
**Para** incluir más escuelas en el programa de reciclaje

**Criterios de Aceptación:**
- Debe mostrar formulario con: nombre, dirección, nivel educativo
- Debe validar que el nombre sea único
- Debe permitir guardar la institución
- Debe mostrar confirmación de creación
- Debe redirigir a lista de instituciones

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-015: Listar Instituciones

**Como** administrador  
**Quiero** ver todas las instituciones registradas  
**Para** tener un inventario completo

**Criterios de Aceptación:**
- Debe mostrar tabla con todas las instituciones
- Debe mostrar: nombre, dirección, nivel, proyectos asociados
- Debe permitir buscar por nombre
- Debe incluir acciones: ver, editar, eliminar
- Debe mostrar cantidad de participantes por institución

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-016: Editar Institución

**Como** administrador  
**Quiero** modificar datos de instituciones  
**Para** mantener información actualizada

**Criterios de Aceptación:**
- Debe mostrar formulario con datos actuales
- Debe permitir modificar nombre, dirección y nivel
- Debe validar cambios
- Debe actualizar la información
- Debe mostrar mensaje de éxito

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-017: Eliminar Institución

**Como** administrador  
**Quiero** eliminar instituciones que ya no participan  
**Para** mantener datos actualizados

**Criterios de Aceptación:**
- Debe solicitar confirmación
- Debe validar que no tenga participantes activos
- Debe mostrar advertencia si tiene datos relacionados
- Debe eliminar la institución
- Debe mostrar confirmación

**Prioridad:** Baja  
**Estimación:** 2 puntos

---

## 4. GESTIÓN DE PARTICIPANTES

### HU-018: Registrar Participante

**Como** administrador  
**Quiero** registrar nuevos participantes (estudiantes)  
**Para** incluirlos en el programa de reciclaje

**Criterios de Aceptación:**
- Debe mostrar formulario con: DNI, nombres, apellidos, institución-proyecto
- Debe validar que el DNI sea único por institución-proyecto
- Debe permitir seleccionar nivel académico, ciclo/grado, aula
- Debe generar UUID único para el participante
- Debe establecer año de participación
- Debe inicializar puntaje en 0
- Debe crear usuario asociado si no existe

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-019: Listar Participantes

**Como** administrador  
**Quiero** ver todos los participantes registrados  
**Para** gestionarlos y revisar su información

**Criterios de Aceptación:**
- Debe mostrar tabla con participantes
- Debe mostrar: nombre completo, DNI, institución, proyecto, puntaje
- Debe permitir filtrar por proyecto e institución
- Debe permitir buscar por DNI o nombre
- Debe incluir acciones: ver, editar, eliminar
- Debe mostrar paginación

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-020: Buscar Participante

**Como** administrador  
**Quiero** buscar participantes por DNI o nombre  
**Para** encontrar rápidamente información de un estudiante

**Criterios de Aceptación:**
- Debe mostrar campo de búsqueda
- Debe buscar en DNI, nombres y apellidos
- Debe mostrar resultados en tiempo real o al enviar
- Debe mostrar información completa del participante
- Debe permitir acceder al detalle del participante

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-021: Ver Detalle de Participante

**Como** administrador  
**Quiero** ver información detallada de un participante  
**Para** revisar su historial y estadísticas

**Criterios de Aceptación:**
- Debe mostrar información personal completa
- Debe mostrar institución y proyecto asociado
- Debe mostrar puntaje total y posición en ranking
- Debe mostrar historial de recolecciones
- Debe mostrar historial de canjes
- Debe mostrar nivel académico y aula

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-022: Editar Participante

**Como** administrador  
**Quiero** modificar información de participantes  
**Para** corregir datos o actualizar información

**Criterios de Aceptación:**
- Debe mostrar formulario con datos actuales
- Debe permitir modificar: nivel académico, ciclo/grado, aula
- Debe validar cambios
- Debe actualizar la información
- Debe mostrar mensaje de éxito
- No debe permitir modificar DNI ni institución-proyecto

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-023: Eliminar Participante

**Como** administrador  
**Quiero** eliminar participantes del sistema  
**Para** mantener datos actualizados

**Criterios de Aceptación:**
- Debe solicitar confirmación
- Debe validar que no tenga recolecciones validadas
- Debe mostrar advertencia si tiene datos relacionados
- Debe eliminar el participante
- Debe mostrar confirmación

**Prioridad:** Baja  
**Estimación:** 2 puntos

---

## 5. GESTIÓN DE MATERIALES RECICLABLES

### HU-024: Crear Material Reciclable

**Como** administrador  
**Quiero** registrar nuevos tipos de materiales reciclables  
**Para** ampliar las opciones de recolección

**Criterios de Aceptación:**
- Debe mostrar formulario con: nombre y foto del material
- Debe permitir subir imagen del material
- Debe validar que el nombre sea único
- Debe guardar el material
- Debe mostrar confirmación
- Debe redirigir a lista de materiales

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-025: Listar Materiales

**Como** administrador  
**Quiero** ver todos los materiales registrados  
**Para** gestionarlos y asignarles precios

**Criterios de Aceptación:**
- Debe mostrar tabla con materiales
- Debe mostrar: nombre, foto, cantidad de precios asignados
- Debe permitir buscar por nombre
- Debe incluir acciones: ver, editar, eliminar, gestionar precios
- Debe mostrar paginación

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-026: Editar Material

**Como** administrador  
**Quiero** modificar información de materiales  
**Para** actualizar datos o cambiar foto

**Criterios de Aceptación:**
- Debe mostrar formulario con datos actuales
- Debe permitir modificar nombre y foto
- Debe validar cambios
- Debe actualizar el material
- Debe mostrar mensaje de éxito

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-027: Eliminar Material

**Como** administrador  
**Quiero** eliminar materiales que ya no se reciclan  
**Para** mantener el catálogo actualizado

**Criterios de Aceptación:**
- Debe solicitar confirmación
- Debe validar que no tenga precios asignados
- Debe mostrar advertencia si tiene recolecciones asociadas
- Debe eliminar el material
- Debe mostrar confirmación

**Prioridad:** Baja  
**Estimación:** 2 puntos

---

### HU-028: Asignar Precio y Puntaje a Material por Proyecto

**Como** administrador  
**Quiero** asignar precios y puntajes a materiales por proyecto  
**Para** definir cuántos puntos genera cada material en cada proyecto

**Criterios de Aceptación:**
- Debe mostrar lista de materiales disponibles
- Debe permitir seleccionar material, precio y proyecto
- Debe permitir establecer puntaje por kilogramo
- Debe permitir establecer fechas de vigencia
- Debe validar que no haya duplicados
- Debe mostrar precios ya asignados

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-029: Gestionar Precios de Material

**Como** administrador  
**Quiero** agregar, editar y eliminar precios de un material  
**Para** mantener actualizados los valores de puntuación

**Criterios de Aceptación:**
- Debe mostrar lista de precios asignados al material
- Debe permitir agregar nuevo precio con proyecto
- Debe permitir editar precio existente
- Debe permitir eliminar precio
- Debe mostrar información: proyecto, puntaje, fechas de vigencia
- Debe validar fechas de vigencia

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-030: Ver Materiales por Proyecto

**Como** administrador  
**Quiero** ver materiales disponibles para un proyecto específico  
**Para** conocer qué materiales se pueden recolectar en ese proyecto

**Criterios de Aceptación:**
- Debe permitir seleccionar proyecto
- Debe mostrar lista de materiales con precios asignados
- Debe mostrar puntaje por kilogramo de cada material
- Debe mostrar estado de vigencia
- Debe permitir filtrar por material

**Prioridad:** Media  
**Estimación:** 2 puntos

---

## 6. REGISTRO DE RECOLECCIONES

### HU-031: Registrar Recolección (Paso 1: Seleccionar Proyecto)

**Como** administrador  
**Quiero** seleccionar el proyecto para registrar una recolección  
**Para** iniciar el proceso de registro

**Criterios de Aceptación:**
- Debe mostrar lista de proyectos activos
- Debe permitir buscar proyecto por nombre
- Debe mostrar solo proyectos con estado "Activo"
- Debe permitir seleccionar un proyecto
- Debe redirigir al siguiente paso tras seleccionar

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-032: Registrar Recolección (Paso 2: Seleccionar Institución)

**Como** administrador  
**Quiero** seleccionar la institución del proyecto  
**Para** continuar con el registro de recolección

**Criterios de Aceptación:**
- Debe mostrar instituciones asociadas al proyecto seleccionado
- Debe permitir buscar institución por nombre
- Debe mostrar solo instituciones activas en el proyecto
- Debe permitir seleccionar una institución
- Debe redirigir al siguiente paso

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-033: Registrar Recolección (Paso 3: Seleccionar Participantes)

**Como** administrador  
**Quiero** seleccionar los participantes de la recolección  
**Para** asignar los materiales recolectados a estudiantes

**Criterios de Aceptación:**
- Debe mostrar participantes de la institución-proyecto
- Debe permitir seleccionar múltiples participantes
- Debe permitir buscar participante por DNI o nombre
- Debe mostrar información básica de cada participante
- Debe permitir continuar al siguiente paso

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-034: Registrar Recolección (Paso 4: Registrar Materiales)

**Como** administrador  
**Quiero** registrar los materiales recolectados por cada participante  
**Para** asignar puntos y actualizar estadísticas

**Criterios de Aceptación:**
- Debe mostrar formulario para cada participante seleccionado
- Debe permitir seleccionar material disponible en el proyecto
- Debe permitir ingresar cantidad en kilogramos
- Debe mostrar fecha de recolección
- Debe calcular puntos automáticamente
- Debe permitir agregar múltiples materiales por participante
- Debe validar que la cantidad sea mayor a 0
- Debe guardar recolecciones con estado "Pendiente"
- Debe mostrar resumen antes de confirmar

**Prioridad:** Alta  
**Estimación:** 5 puntos

---

### HU-035: Registrar Recolección por UUID

**Como** administrador  
**Quiero** registrar recolección usando el UUID de un participante  
**Para** agilizar el proceso cuando se conoce el identificador

**Criterios de Aceptación:**
- Debe mostrar campo para ingresar UUID
- Debe validar que el UUID exista
- Debe mostrar información del participante encontrado
- Debe permitir registrar materiales directamente
- Debe mostrar institución y proyecto del participante
- Debe calcular puntos según el proyecto

**Prioridad:** Media  
**Estimación:** 3 puntos

---

### HU-036: Listar Recolecciones

**Como** administrador  
**Quiero** ver todas las recolecciones registradas  
**Para** revisar y gestionar el historial

**Criterios de Aceptación:**
- Debe mostrar tabla con recolecciones
- Debe mostrar: participante, material, cantidad, fecha, estado
- Debe permitir filtrar por: proyecto, institución, participante, estado, fechas
- Debe permitir buscar por DNI o nombre de participante
- Debe incluir acciones: ver, validar, eliminar
- Debe mostrar paginación

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-037: Validar Recolección

**Como** administrador  
**Quiero** validar recolecciones pendientes  
**Para** confirmar que los datos son correctos y asignar puntos

**Criterios de Aceptación:**
- Debe permitir cambiar estado de "Pendiente" a "Validado"
- Debe actualizar puntaje del participante al validar
- Debe calcular puntos según material y cantidad
- Debe actualizar ranking del participante
- Debe mostrar confirmación de validación
- Debe permitir rechazar recolección (cambiar a "Rechazado")

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-038: Eliminar Recolección

**Como** administrador  
**Quiero** eliminar recolecciones incorrectas  
**Para** mantener la integridad de los datos

**Criterios de Aceptación:**
- Debe solicitar confirmación antes de eliminar
- Debe validar que la recolección no esté validada (o revertir puntos si está validada)
- Debe revertir puntos del participante si estaba validada
- Debe actualizar ranking si se revierten puntos
- Debe eliminar la recolección
- Debe mostrar confirmación

**Prioridad:** Media  
**Estimación:** 3 puntos

---

## 7. SISTEMA DE PREMIOS

### HU-039: Crear Premio

**Como** administrador  
**Quiero** crear nuevos premios para canje  
**Para** motivar a los participantes con recompensas

**Criterios de Aceptación:**
- Debe mostrar formulario con: artículo, institución-proyecto, tipo, puntaje/posición requerida
- Debe permitir seleccionar artículo existente o crear nuevo
- Debe permitir seleccionar tipo: "Canje por puntaje" o "Canje por Ranking"
- Debe requerir puntaje requerido si es por puntaje
- Debe requerir posición requerida si es por ranking
- Debe permitir establecer estado (Disponible/No disponible)
- Debe guardar el premio
- Debe mostrar confirmación

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-040: Listar Premios

**Como** administrador  
**Quiero** ver todos los premios registrados  
**Para** gestionarlos y revisar disponibilidad

**Criterios de Aceptación:**
- Debe mostrar tabla con premios
- Debe mostrar: artículo, institución-proyecto, tipo, requisito, estado
- Debe permitir filtrar por: proyecto, institución, tipo, estado
- Debe incluir acciones: ver, editar, eliminar
- Debe mostrar cantidad de canjes realizados
- Debe mostrar paginación

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-041: Editar Premio

**Como** administrador  
**Quiero** modificar información de premios  
**Para** actualizar requisitos o cambiar estado

**Criterios de Aceptación:**
- Debe mostrar formulario con datos actuales
- Debe permitir modificar: artículo, tipo, requisitos, estado
- Debe validar cambios
- Debe actualizar el premio
- Debe mostrar mensaje de éxito
- Debe validar que no haya canjes pendientes si se cambia requisito

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-042: Eliminar Premio

**Como** administrador  
**Quiero** eliminar premios que ya no se ofrecen  
**Para** mantener el catálogo actualizado

**Criterios de Aceptación:**
- Debe solicitar confirmación
- Debe validar que no tenga canjes asociados
- Debe mostrar advertencia si tiene canjes
- Debe eliminar el premio
- Debe mostrar confirmación

**Prioridad:** Baja  
**Estimación:** 2 puntos

---

### HU-043: Gestionar Artículos

**Como** administrador  
**Quiero** crear y gestionar artículos que se pueden canjear  
**Para** tener un catálogo de premios disponibles

**Criterios de Aceptación:**
- Debe permitir crear artículos con: nombre, foto, precio
- Debe permitir listar todos los artículos
- Debe permitir editar artículos
- Debe permitir eliminar artículos (si no tienen premios asociados)
- Debe mostrar artículos en formulario de crear premio
- Debe validar datos antes de guardar

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-044: Ver Premios Disponibles (Participante)

**Como** participante  
**Quiero** ver los premios que puedo canjear  
**Para** conocer las recompensas disponibles según mi puntaje y posición

**Criterios de Aceptación:**
- Debe mostrar premios por puntaje ordenados por requisito
- Debe mostrar premios por ranking ordenados por posición
- Debe indicar qué premios ya alcancé
- Debe indicar cuántos puntos faltan para el siguiente premio
- Debe mostrar línea de progreso hacia siguiente premio
- Debe mostrar información del artículo (nombre, foto)
- Debe permitir solicitar canje de premios alcanzados

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

## 8. SISTEMA DE CANJES

### HU-045: Solicitar Canje de Premio (Participante)

**Como** participante  
**Quiero** solicitar el canje de un premio que alcancé  
**Para** obtener mi recompensa

**Criterios de Aceptación:**
- Debe mostrar solo premios que el participante puede canjear
- Debe validar que el participante cumpla requisitos (puntaje o posición)
- Debe permitir seleccionar premio disponible
- Debe crear solicitud de canje con estado "Pendiente"
- Debe mostrar confirmación de solicitud
- Debe registrar fecha de solicitud

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-046: Ver Historial de Canjes (Participante)

**Como** participante  
**Quiero** ver mi historial de canjes solicitados  
**Para** conocer el estado de mis solicitudes

**Criterios de Aceptación:**
- Debe mostrar lista de canjes del participante
- Debe mostrar: premio, fecha de solicitud, estado, fecha de entrega
- Debe permitir filtrar por estado
- Debe permitir buscar por nombre de premio
- Debe permitir ordenar por fecha
- Debe mostrar información detallada de cada canje
- Debe mostrar paginación

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-047: Listar Canjes (Administrador)

**Como** administrador  
**Quiero** ver todas las solicitudes de canje  
**Para** gestionarlas y programar entregas

**Criterios de Aceptación:**
- Debe mostrar tabla con todos los canjes
- Debe mostrar: participante, premio, fecha solicitud, estado
- Debe permitir filtrar por: estado, proyecto, institución, fechas
- Debe incluir acciones: ver detalle, actualizar estado, eliminar
- Debe mostrar estadísticas: total, pendientes, programados, entregados
- Debe mostrar paginación

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-048: Ver Detalle de Canje (Administrador)

**Como** administrador  
**Quiero** ver información detallada de un canje  
**Para** revisar datos y gestionar la entrega

**Criterios de Aceptación:**
- Debe mostrar información completa del canje
- Debe mostrar datos del participante
- Debe mostrar información del premio
- Debe mostrar estado actual
- Debe mostrar respuesta programada si existe
- Debe permitir actualizar estado
- Debe permitir programar entrega

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-049: Programar Entrega de Premio

**Como** administrador  
**Quiero** programar la entrega de un premio canjeado  
**Para** coordinar la entrega física del premio

**Criterios de Aceptación:**
- Debe permitir cambiar estado a "Programado"
- Debe solicitar: lugar, fecha programada, hora
- Debe validar que la fecha sea futura
- Debe crear registro de respuesta con los datos
- Debe actualizar el canje con la respuesta
- Debe mostrar confirmación
- Debe notificar al participante (si hay sistema de notificaciones)

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-050: Marcar Premio como Entregado

**Como** administrador  
**Quiero** marcar un premio como entregado  
**Para** completar el proceso de canje

**Criterios de Aceptación:**
- Debe permitir cambiar estado a "Entregado"
- Debe registrar fecha y hora de entrega automáticamente
- Debe validar que el canje esté en estado "Programado"
- Debe actualizar el estado del canje
- Debe mostrar confirmación
- Debe cerrar el proceso de canje

**Prioridad:** Alta  
**Estimación:** 2 puntos

---

### HU-051: Eliminar Canje

**Como** administrador  
**Quiero** eliminar canjes incorrectos o cancelados  
**Para** mantener datos precisos

**Criterios de Aceptación:**
- Debe solicitar confirmación
- Debe eliminar el canje y su respuesta asociada
- Debe mostrar confirmación
- Debe validar permisos antes de eliminar

**Prioridad:** Baja  
**Estimación:** 2 puntos

---

## 9. RANKING Y COMPETENCIAS

### HU-052: Ver Ranking Institucional (Participante)

**Como** participante  
**Quiero** ver el ranking de mi institución en el proyecto  
**Para** conocer mi posición y la de mis compañeros

**Criterios de Aceptación:**
- Debe mostrar ranking ordenado por puntaje descendente
- Debe mostrar: posición, nombre, puntaje total
- Debe resaltar la posición del participante actual
- Debe mostrar total de participantes
- Debe permitir filtrar por proyecto (si participa en varios)
- Debe mostrar información de institución y proyecto

**Prioridad:** Alta  
**Estimación:** 3 puntos

---

### HU-053: Ver Ranking General (Administrador)

**Como** administrador  
**Quiero** ver rankings de todos los proyectos e instituciones  
**Para** analizar el desempeño y generar reportes

**Criterios de Aceptación:**
- Debe permitir seleccionar proyecto
- Debe permitir seleccionar institución
- Debe mostrar ranking ordenado por puntaje
- Debe mostrar: posición, participante, institución, puntaje
- Debe permitir exportar ranking (si está implementado)
- Debe mostrar estadísticas del ranking

**Prioridad:** Media  
**Estimación:** 3 puntos

---

### HU-054: Calcular Puntajes y Posiciones

**Como** sistema  
**Quiero** calcular automáticamente puntajes y posiciones  
**Para** mantener rankings actualizados

**Criterios de Aceptación:**
- Debe calcular puntaje total sumando puntos de recolecciones validadas
- Debe actualizar puntaje del participante al validar recolección
- Debe recalcular posiciones en ranking al cambiar puntajes
- Debe mantener ranking por institución-proyecto
- Debe actualizar en tiempo real

**Prioridad:** Alta  
**Estimación:** 5 puntos

---

## 10. GESTIÓN DE ANUNCIOS

### HU-055: Crear Anuncio

**Como** administrador  
**Quiero** crear anuncios para instituciones-proyectos  
**Para** comunicar información importante a los participantes

**Criterios de Aceptación:**
- Debe mostrar formulario con: institución-proyecto, motivo, fecha, hora, lugar
- Debe permitir establecer fechas de publicación (inicial y final)
- Debe permitir establecer estado (Activo/Inactivo)
- Debe validar que la fecha inicial sea anterior a la final
- Debe guardar el anuncio
- Debe mostrar confirmación

**Prioridad:** Media  
**Estimación:** 3 puntos

---

### HU-056: Listar Anuncios

**Como** administrador  
**Quiero** ver todos los anuncios creados  
**Para** gestionarlos y revisar su estado

**Criterios de Aceptación:**
- Debe mostrar tabla con anuncios
- Debe mostrar: institución-proyecto, motivo, fecha, estado
- Debe permitir filtrar por proyecto e institución
- Debe permitir buscar por motivo
- Debe incluir acciones: ver, editar, eliminar
- Debe mostrar paginación

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-057: Editar Anuncio

**Como** administrador  
**Quiero** modificar información de anuncios  
**Para** actualizar datos o cambiar fechas

**Criterios de Aceptación:**
- Debe mostrar formulario con datos actuales
- Debe permitir modificar todos los campos
- Debe validar cambios
- Debe actualizar el anuncio
- Debe mostrar mensaje de éxito

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-058: Eliminar Anuncio

**Como** administrador  
**Quiero** eliminar anuncios que ya no son necesarios  
**Para** mantener información actualizada

**Criterios de Aceptación:**
- Debe solicitar confirmación
- Debe eliminar el anuncio
- Debe mostrar confirmación

**Prioridad:** Baja  
**Estimación:** 1 punto

---

### HU-059: Ver Anuncios (Participante)

**Como** participante  
**Quiero** ver los anuncios de mi institución y proyecto  
**Para** estar informado de eventos y comunicaciones importantes

**Criterios de Aceptación:**
- Debe mostrar anuncios activos de la institución-proyecto del participante
- Debe mostrar solo anuncios dentro de su período de publicación
- Debe mostrar: motivo, fecha, hora, lugar
- Debe ordenar por fecha más reciente
- Debe mostrar mensaje si no hay anuncios

**Prioridad:** Media  
**Estimación:** 2 puntos

---

## 11. DASHBOARDS Y REPORTES

### HU-060: Dashboard Administrativo

**Como** administrador  
**Quiero** ver un dashboard con estadísticas y métricas del sistema  
**Para** tener una visión general del desempeño del programa

**Criterios de Aceptación:**
- Debe mostrar métricas principales: proyectos activos, instituciones, participantes, kg reciclados, premios disponibles
- Debe mostrar gráficas: materiales más reciclados, participación mensual, instituciones top, distribución de materiales
- Debe mostrar evolución de recolecciones (últimos 30 días)
- Debe mostrar material más reciclado e institución con mayor recolección
- Debe mostrar total de puntos generados
- Debe actualizar datos en tiempo real

**Prioridad:** Alta  
**Estimación:** 5 puntos

---

### HU-061: Dashboard de Participante

**Como** participante  
**Quiero** ver mi dashboard personal con mi progreso  
**Para** conocer mis estadísticas y logros

**Criterios de Aceptación:**
- Debe mostrar información personal: nombre, institución, proyecto
- Debe mostrar puntaje total y posición en ranking
- Debe mostrar total de kilogramos reciclados
- Debe mostrar gráfico de materiales reciclados (distribución)
- Debe mostrar premios disponibles y próximos premios
- Debe mostrar línea de progreso hacia siguiente premio
- Debe mostrar ranking institucional (top participantes)
- Debe mostrar premios por ranking disponibles

**Prioridad:** Alta  
**Estimación:** 5 puntos

---

### HU-062: Reportes de Recolecciones

**Como** administrador  
**Quiero** generar reportes de recolecciones  
**Para** analizar datos y tomar decisiones

**Criterios de Aceptación:**
- Debe permitir filtrar por: proyecto, institución, fechas, material
- Debe mostrar resumen de recolecciones
- Debe mostrar totales por material
- Debe mostrar totales por institución
- Debe mostrar gráficas de tendencias
- Debe permitir exportar datos (si está implementado)

**Prioridad:** Media  
**Estimación:** 4 puntos

---

## 12. CONFIGURACIÓN DEL SISTEMA

### HU-063: Configuración General del Sistema

**Como** administrador  
**Quiero** acceder a configuraciones generales del sistema  
**Para** personalizar parámetros y ajustes

**Criterios de Aceptación:**
- Debe mostrar página de configuración
- Debe permitir modificar parámetros del sistema
- Debe guardar cambios
- Debe mostrar mensaje de confirmación
- Debe validar datos antes de guardar

**Prioridad:** Baja  
**Estimación:** 3 puntos

---

### HU-064: Cambiar Contraseña (Administrador)

**Como** administrador  
**Quiero** cambiar mi contraseña  
**Para** mantener la seguridad de mi cuenta

**Criterios de Aceptación:**
- Debe mostrar formulario de cambio de contraseña
- Debe requerir contraseña actual
- Debe requerir nueva contraseña y confirmación
- Debe validar que las contraseñas coincidan
- Debe validar fortaleza de la nueva contraseña
- Debe actualizar la contraseña
- Debe mostrar mensaje de éxito

**Prioridad:** Media  
**Estimación:** 2 puntos

---

### HU-065: Cambiar Contraseña (Participante)

**Como** participante  
**Quiero** cambiar mi contraseña  
**Para** mantener la seguridad de mi cuenta

**Criterios de Aceptación:**
- Debe mostrar formulario de cambio de contraseña
- Debe requerir contraseña actual
- Debe requerir nueva contraseña y confirmación
- Debe validar que las contraseñas coincidan
- Debe actualizar la contraseña
- Debe mostrar mensaje de éxito

**Prioridad:** Media  
**Estimación:** 2 puntos

---

## RESUMEN DE HISTORIAS DE USUARIO

**Total de Historias de Usuario:** 65

**Por Prioridad:**
- **Alta:** 35 historias
- **Media:** 22 historias
- **Baja:** 8 historias

**Por Módulo:**
- Autenticación y Gestión de Usuarios: 6 historias
- Gestión de Proyectos: 7 historias
- Gestión de Instituciones Educativas: 4 historias
- Gestión de Participantes: 6 historias
- Gestión de Materiales Reciclables: 7 historias
- Registro de Recolecciones: 8 historias
- Sistema de Premios: 6 historias
- Sistema de Canjes: 7 historias
- Ranking y Competencias: 3 historias
- Gestión de Anuncios: 5 historias
- Dashboards y Reportes: 3 historias
- Configuración del Sistema: 3 historias

---

**Documento generado para:** Sistema de Gestión de Reciclaje Educativo - SediEcoTech  
**Última actualización:** 2025

