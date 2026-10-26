# Graph Report - app  (2026-10-22)

## Corpus Check
- Corpus is ~17,206 words - fits in a single context window. You may not need a graph.

## Summary
- 568 nodes · 1107 edges · 30 communities (8 shown, 22 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 10 edges (avg confidence: 0.85)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- Account Management
- Authentication and Approvals
- Role Requests and Models
- Calendar and Scheduling
- Console Jobs and Imports
- Document Model Relations
- User Model and Verification
- Access Control Middleware
- Document Workflow Management
- Drive and Resource Controllers
- PPA File Management
- Dashboard and Sections
- Document Workflow Actions
- Resource File Operations
- Application Service Provider
- Document Process Policies
- Registration and Holiday Jobs
- Calendar Event Policies
- Console Scheduling
- Drive Storage Operations
- Section File Management
- User Administration
- Document Authorization
- PPA Section Files
- Focal Person Notifications
- Deadline Notifications
- Archive Management

## God Nodes (most connected - your core abstractions)
1. `User` - 74 edges
2. `Controller` - 36 edges
3. `Document` - 36 edges
4. `DocumentController` - 35 edges
5. `Event` - 22 edges
6. `PpaController` - 19 edges
7. `DocumentWorkflowController` - 18 edges
8. `Section` - 18 edges
9. `DocumentProcess` - 15 edges
10. `ResourceController` - 13 edges

## Surprising Connections (you probably didn't know these)
- `{closure#1}()` --references--> `Document`  [EXTRACTED]
  Console/Commands/DeleteOldDocuments.php → Models/Document.php
- `{closure#1}()` --calls--> `Event`  [INFERRED]
  Http/Controllers/Auth/NewPasswordController.php → Models/Event.php
- `{closure#1}()` --references--> `User`  [EXTRACTED]
  Providers/AppServiceProvider.php → Models/User.php
- `{closure#3}()` --references--> `User`  [EXTRACTED]
  Providers/AppServiceProvider.php → Models/User.php
- `{closure#4}()` --references--> `User`  [EXTRACTED]
  Providers/AppServiceProvider.php → Models/User.php

## Import Cycles
- None detected.

## Communities (30 total, 22 thin omitted)

### Community 0 - "Account Management"
Cohesion: 0.05
Nodes (8): AccountManagementController, UserApprovedMail, UserDeclinedMail, AccountApproved, AccountDeclined, CustomResetPasswordNotification, CustomVerifyEmail, DocumentAssignedNotification

### Community 1 - "Authentication and Approvals"
Cohesion: 0.05
Nodes (17): ApprovalController, AuthenticatedSessionController, ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, {closure#1}(), NewPasswordController, PasswordController (+9 more)

### Community 2 - "Role Requests and Models"
Cohesion: 0.05
Nodes (13): RoleRequestController, archive, Audit, Division, DocumentAssignment, DocumentSchedule, DocumentWorkflowLog, DriveFile (+5 more)

### Community 3 - "Calendar and Scheduling"
Cohesion: 0.06
Nodes (6): CalendarController, {closure#2}(), LoginRequest, StoreEventRequest, UpdateUserRoleRequest, Event

### Community 4 - "Console Jobs and Imports"
Cohesion: 0.14
Nodes (5): {closure#1}(), DeleteOldDocuments, ImportHolidays, BusinessDayHelper, HolidayService

### Community 8 - "Access Control Middleware"
Cohesion: 0.18
Nodes (5): AdminMiddleware, DenyWriteAccessForTechInspector, EmployeeMiddleware, EnsureUserIsApproved, SecurityHeaders

### Community 12 - "Dashboard and Sections"
Cohesion: 0.14
Nodes (3): DashboardController, SectionController, Section

### Community 15 - "Application Service Provider"
Cohesion: 0.17
Nodes (5): AppServiceProvider, {closure#1}(), {closure#3}(), {closure#4}(), {closure#5}()

## Knowledge Gaps
- **22 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `User` connect `User Model and Verification` to `Account Management`, `Authentication and Approvals`, `Role Requests and Models`, `Calendar and Scheduling`, `Console Jobs and Imports`, `Document Rendering`, `Document Model Relations`, `Dashboard and Sections`, `Application Service Provider`, `Document Process Policies`, `Calendar Event Policies`, `User Administration`, `Document Authorization`, `Document Workflow Controllers`?**
  _High betweenness centrality (0.265) - this node is a cross-community bridge._
- **Should `Account Management` be split into smaller, more focused modules?**
  _Cohesion score 0.05086071987480438 - nodes in this community are weakly interconnected._
- **Why does `Controller` connect `Authentication and Approvals` to `Account Management`, `Role Requests and Models`, `Calendar and Scheduling`, `Document Workflow Management`, `PPA File Management`, `Dashboard and Sections`, `Document Workflow Actions`, `Resource File Operations`, `Drive Storage Operations`, `Section File Management`, `User Administration`, `PPA Section Files`, `Archive Management`?**
  _High betweenness centrality (0.148) - this node is a cross-community bridge._
- **Should `Authentication and Approvals` be split into smaller, more focused modules?**
  _Cohesion score 0.05203442879499218 - nodes in this community are weakly interconnected._
- **Why does `Document` connect `Document Model Relations` to `Account Management`, `Role Requests and Models`, `Console Jobs and Imports`, `Document Rendering`, `Document Workflow Management`, `Dashboard and Sections`, `Application Service Provider`, `Document Process Policies`, `Schedule Progress Tracking`, `Document Authorization`, `Focal Person Notifications`?**
  _High betweenness centrality (0.092) - this node is a cross-community bridge._
- **Should `Role Requests and Models` be split into smaller, more focused modules?**
  _Cohesion score 0.05101327742837177 - nodes in this community are weakly interconnected._
- **Should `Calendar and Scheduling` be split into smaller, more focused modules?**
  _Cohesion score 0.06025369978858351 - nodes in this community are weakly interconnected._