---
name: Padrão de Desenvolvimento Alvras
description: Guia de arquitetura e padrões técnicos para o projeto Alvras.
---

# Padrão de Desenvolvimento Alvras

Este documento define os padrões técnicos e arquiteturais que devem ser seguidos em todo o projeto para garantir consistência, manutenibilidade e escalabilidade.

## 1. Arquitetura de Software (Action-Service-DTO)

Para evitar controladores "gordos" (fat controllers) e lógica espalhada, utilizamos o padrão de três camadas:

### **DTO (Data Transfer Object)**
- Local: `app/DTOs/`
- Propósito: Validar e tipar os dados que entram no sistema.
- Regra: Todo dado vindo do Request deve ser convertido em um DTO antes de ir para o Service.

### **Service (Regra de Negócio)**
- Local: `app/Services/`
- Propósito: Conter a lógica de negócio pesada, orquestração de processos e cálculos.
- Regra: Services não devem lidar com HTTP (Request/Response). Eles recebem DTOs e retornam Models ou Coleções.

### **Action (Ação Única)**
- Local: `app/Actions/`
- Propósito: Executar uma única tarefa atômica (ex: `GerarPdfAlvara`).
- Regra: Deve ser uma classe com um único método público (ex: `handle()` ou `execute()`).

---

## 2. Multi-Tenancy (Multi-Empresa)

O sistema é estritamente multi-tenant. Cada usuário pertence a um "Owner" (`owner_id`).

- **HasOwner Trait**: Todo model que pertence a um tenant (Empresa, Alvará, Usuário) deve usar a trait `App\Traits\HasOwner`.
- **Global Scope**: A trait `HasOwner` aplica automaticamente o `OwnerScope`, garantindo que um cliente NUNCA veja dados de outro cliente.
- **Segurança**: Nunca ignore o `owner_id` em consultas manuais, a menos que seja no painel de Super Admin (`/admin`).

---

## 3. Padrões de Interface (UI/UX)

- **Branding**: Use sempre o logotipo oficial (`public/logo.png`) no sidebar e header.
- **Simplicidade**: Evite cabeçalhos redundantes. O layout deve ser limpo e focado nos dados.
- **Navegação**: O sidebar lateral é a fonte primária de navegação. Componentes repetidos no topo devem ser removidos.

---

## 4. Banco de Dados e Eloquent

- **Model Scopes**: Lógica de filtragem comum (ex: `status = 'vencido'`) deve estar em Scopes no Model, não no Controller.
- **Naming**: Tabelas em plural (`empresas`), Pivot tables em ordem alfabética (`empresa_tipo_alvara`).
- **N+1**: Sempre use `with()` para carregar relacionamentos em listas.

---

## 5. Regras de Ouro
1. **NUNCA** faça consultas ao banco de dados dentro de arquivos Blade (.blade.php).
2. **NUNCA** use `env()` diretamente no código (use `config()`).
3. **SEMPRE** use `FormRequest` para validação de entrada.

---
*Atualizado em: 24/03/2026*
