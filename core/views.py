from django.views.generic import TemplateView, ListView, DetailView
from .models import Resource


class HomeView(TemplateView):
    template_name = "index.html"


class ResourceListView(ListView):
    model = Resource
    context_object_name = "resources"
    template_name = "resources/list.html"


class ResourceDetailView(DetailView):
    model = Resource
    context_object_name = "resource"
    template_name = "resources/detail.html"

