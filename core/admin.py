from django.contrib import admin
from .models import (
    Department,
    Team,
    Tag,
    Resource,
    ResourceRelationshipType,
    ResourceRelationship,
)


@admin.register(Department)
class DepartmentAdmin(admin.ModelAdmin):
    list_display = ("code", "name", "created_at", "updated_at")
    search_fields = ("code", "name", "description")


@admin.register(Team)
class TeamAdmin(admin.ModelAdmin):
    list_display = ("name", "department", "email")
    list_filter = ("department",)
    search_fields = ("name", "email")


@admin.register(Tag)
class TagAdmin(admin.ModelAdmin):
    list_display = ("name",)
    search_fields = ("name",)


@admin.register(Resource)
class ResourceAdmin(admin.ModelAdmin):
    list_display = ("name", "resource_type", "department", "owner_team")
    list_filter = ("resource_type", "department", "owner_team", "tags")
    search_fields = ("name", "description")
    filter_horizontal = ("support_teams", "tags")


@admin.register(ResourceRelationshipType)
class ResourceRelationshipTypeAdmin(admin.ModelAdmin):
    list_display = ("name", "is_symmetric")
    search_fields = ("name",)


@admin.register(ResourceRelationship)
class ResourceRelationshipAdmin(admin.ModelAdmin):
    list_display = ("relation_type", "source", "target")
    list_filter = ("relation_type",)
    search_fields = ("source__name", "target__name")

