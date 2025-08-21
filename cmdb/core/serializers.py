from rest_framework import serializers
from .models import (
    Department,
    Team,
    Tag,
    Resource,
    ResourceRelationshipType,
    ResourceRelationship,
)


class DepartmentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Department
        fields = ["id", "name", "code", "description", "created_at", "updated_at"]


class TeamSerializer(serializers.ModelSerializer):
    department = DepartmentSerializer(read_only=True)
    department_id = serializers.PrimaryKeyRelatedField(
        queryset=Department.objects.all(), source="department", write_only=True
    )

    class Meta:
        model = Team
        fields = [
            "id",
            "name",
            "email",
            "department",
            "department_id",
            "created_at",
            "updated_at",
        ]


class TagSerializer(serializers.ModelSerializer):
    class Meta:
        model = Tag
        fields = ["id", "name", "created_at", "updated_at"]


class ResourceSerializer(serializers.ModelSerializer):
    department = DepartmentSerializer(read_only=True)
    department_id = serializers.PrimaryKeyRelatedField(
        queryset=Department.objects.all(), source="department", write_only=True, allow_null=True, required=False
    )
    owner_team = TeamSerializer(read_only=True)
    owner_team_id = serializers.PrimaryKeyRelatedField(
        queryset=Team.objects.all(), source="owner_team", write_only=True, allow_null=True, required=False
    )
    support_teams = TeamSerializer(many=True, read_only=True)
    support_team_ids = serializers.PrimaryKeyRelatedField(
        many=True, queryset=Team.objects.all(), source="support_teams", write_only=True, required=False
    )
    tags = TagSerializer(many=True, read_only=True)
    tag_ids = serializers.PrimaryKeyRelatedField(
        many=True, queryset=Tag.objects.all(), source="tags", write_only=True, required=False
    )

    class Meta:
        model = Resource
        fields = [
            "id",
            "name",
            "resource_type",
            "description",
            "metadata",
            "department",
            "department_id",
            "owner_team",
            "owner_team_id",
            "support_teams",
            "support_team_ids",
            "tags",
            "tag_ids",
            "created_at",
            "updated_at",
        ]


class ResourceRelationshipTypeSerializer(serializers.ModelSerializer):
    class Meta:
        model = ResourceRelationshipType
        fields = ["id", "name", "description", "is_symmetric", "created_at", "updated_at"]


class ResourceNestedSerializer(serializers.ModelSerializer):
    class Meta:
        model = Resource
        fields = ["id", "name", "resource_type"]


class ResourceRelationshipSerializer(serializers.ModelSerializer):
    relation_type = ResourceRelationshipTypeSerializer(read_only=True)
    relation_type_id = serializers.PrimaryKeyRelatedField(
        queryset=ResourceRelationshipType.objects.all(), source="relation_type", write_only=True
    )
    source = ResourceNestedSerializer(read_only=True)
    source_id = serializers.PrimaryKeyRelatedField(
        queryset=Resource.objects.all(), source="source", write_only=True
    )
    target = ResourceNestedSerializer(read_only=True)
    target_id = serializers.PrimaryKeyRelatedField(
        queryset=Resource.objects.all(), source="target", write_only=True
    )

    class Meta:
        model = ResourceRelationship
        fields = [
            "id",
            "relation_type",
            "relation_type_id",
            "source",
            "source_id",
            "target",
            "target_id",
            "metadata",
            "created_at",
            "updated_at",
        ]

