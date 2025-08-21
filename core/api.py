from rest_framework import viewsets
from .models import (
    Department,
    Team,
    Tag,
    Resource,
    ResourceRelationshipType,
    ResourceRelationship,
)
from .serializers import (
    DepartmentSerializer,
    TeamSerializer,
    TagSerializer,
    ResourceSerializer,
    ResourceRelationshipTypeSerializer,
    ResourceRelationshipSerializer,
)


class DepartmentViewSet(viewsets.ModelViewSet):
    queryset = Department.objects.all().order_by("name")
    serializer_class = DepartmentSerializer


class TeamViewSet(viewsets.ModelViewSet):
    queryset = Team.objects.select_related("department").all().order_by("name")
    serializer_class = TeamSerializer


class TagViewSet(viewsets.ModelViewSet):
    queryset = Tag.objects.all().order_by("name")
    serializer_class = TagSerializer


class ResourceViewSet(viewsets.ModelViewSet):
    queryset = (
        Resource.objects.select_related("department", "owner_team")
        .prefetch_related("support_teams", "tags")
        .all()
        .order_by("name")
    )
    serializer_class = ResourceSerializer


class ResourceRelationshipTypeViewSet(viewsets.ModelViewSet):
    queryset = ResourceRelationshipType.objects.all().order_by("name")
    serializer_class = ResourceRelationshipTypeSerializer


class ResourceRelationshipViewSet(viewsets.ModelViewSet):
    queryset = (
        ResourceRelationship.objects.select_related("relation_type", "source", "target")
        .all()
        .order_by("relation_type__name", "source__name")
    )
    serializer_class = ResourceRelationshipSerializer

